from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager
import time
import os

# 1. Setup WebDriver Chrome otomatis
options = webdriver.ChromeOptions()
# options.add_argument('--headless') # Buka komentar ini jika ingin test berjalan tanpa membuka jendela browser
driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=options)

# Membuat folder penampung bukti screenshot untuk laporan tugas besar
if not os.path.exists('selenium_screenshots'):
    os.makedirs('selenium_screenshots')

try:
    # Set batas tunggu maksimal 10 detik
    wait = WebDriverWait(driver, 10)

    # =========================================================================
    # SKENARIO 1: MEMBUKA HALAMAN LOGIN (Laporan No. 1)
    # =========================================================================
    print("Menjalankan Skenario 1: Membuka Halaman Login...")
    driver.get("http://127.0.0.1:8000/login")
    driver.maximize_window()

    # Memastikan form login utama sudah dirender dengan benar
    wait.until(EC.presence_of_element_located((By.TAG_NAME, "form")))
    driver.save_screenshot("selenium_screenshots/01_halaman_login_tampil.png")
    print("Skenario 1 Berhasil!\n")

    # =========================================================================
    # SKENARIO 2: MENGISI DATA LOGIN (Laporan No. 2)
    # =========================================================================
    print("Menjalankan Skenario 2: Mengisi Data Login...")

    # Mencari kotak input username & password secara fleksibel menggunakan kombinasi XPath
    username_input = wait.until(EC.presence_of_element_located((
        By.XPATH, "//input[@name='username' or @id='username' or contains(@placeholder, 'Username') or contains(@placeholder, 'username')]"
    )))
    password_input = wait.until(EC.presence_of_element_located((
        By.XPATH, "//input[@name='password' or @id='password' or @type='password']"
    )))

    # Memasukkan kredensial dosen wali yang valid dari file seeder timmu
    username_input.clear()
    username_input.send_keys("alifiansyahh")

    password_input.clear()
    password_input.send_keys("dosenmejadua") # Menggunakan password asli dari seeder kelompokmu

    driver.save_screenshot("selenium_screenshots/02_form_login_terisi.png")
    print("Skenario 2 Berhasil!\n")

    # =========================================================================
    # SKENARIO 3: KLIK TOMBOL LOGIN & MASUK DASHBOARD (Laporan No. 3)
    # =========================================================================
    print("Menjalankan Skenario 3: Klik Tombol Login...")

    login_button = wait.until(EC.element_to_be_clickable((
        By.XPATH, "//button[@type='submit'] | //input[@type='submit'] | //button[contains(text(), 'Login')]"
    )))
    login_button.click()

    # Menunggu pengalihan sesi ke rute dashboard dosen wali sesuai berkas web.php timmu
    wait.until(EC.url_contains("/dosen-wali/dashboard"))
    driver.save_screenshot("selenium_screenshots/03_dashboard_dosen_wali.png")
    print("Skenario 3 Berhasil! Berhasil masuk ke Dashboard Dosen Wali.\n")

    # =========================================================================
    # SKENARIO 4: KLIK MENU NILAI PERWALIAN (Laporan No. 4)
    # =========================================================================
    print("Menjalankan Skenario 4: Membuka Halaman Nilai Perwalian...")

    # Mengarahkan browser langsung ke rute nilai perwalian sesuai definisi web.php
    driver.get("http://127.0.0.1:8000/dosen-wali/nilai-perwalian")

    # Memastikan halaman memuat data mahasiswa perwalian bernama BARRA NARENDRA dari DB
    wait.until(EC.presence_of_element_located((By.XPATH, "//*[contains(text(), 'BARRA NARENDRA')]")))
    driver.save_screenshot("selenium_screenshots/04_halaman_nilai_perwalian.png")
    print("Skenario 4 Berhasil! Rekapitulasi nilai mahasiswa perwalian tampil.\n")

    # =========================================================================
    # SKENARIO 5: DRILL-DOWN DETAIL PLO, CLO, & ASSESSMENT TOOLS (Laporan No. 5)
    # =========================================================================
    print("Menjalankan Skenario 5: Menguji Fitur Drill-down Capaian OBE...")

    # Mengakses rute visualisasi capaian untuk Mahasiswa ID: 2 dan PLO ID: 1 sesuai web.php
    driver.get("http://127.0.0.1:8000/nilai/2/plo/1")

    # Menunggu sub-section utama kurikulum OBE ter-render di browser
    wait.until(EC.presence_of_element_located((By.XPATH, "//*[contains(text(), 'Course Learning Outcome') or contains(text(), 'CLO')]")))

    # Memvalidasi integrasi data dari database (Kode CLO01 dan nama alat penilaian Quiz 2)
    assert "CLO01" in driver.page_source, "Error: Entitas data CLO01 tidak ditemukan pada halaman UI!"
    assert "Quiz 2" in driver.page_source, "Error: Alat Penilaian 'Quiz 2' gagal dirender oleh komponen blade!"

    driver.save_screenshot("selenium_screenshots/05_detail_drill_down_clo_at.png")
    print("Skenario 5 Berhasil! Struktur target capaian valid ditampilkan di browser.\n")
    print("=== SELURUH RANGKAIAN AUTOMATION UI TESTING SELESAI DENGAN SUKSES ===")

except Exception as e:
    # Mengambil tindakan screenshot darurat jika terjadi kegagalan interaksi di tengah jalan
    driver.save_screenshot("selenium_screenshots/DEBUG_TERJADI_EROR.png")
    print(f"\n[ERROR] Pengujian terhenti karena kendala teknis: {e}")
    print("Kondisi visual browser saat terjadi error telah disimpan di 'selenium_screenshots/DEBUG_TERJADI_EROR.png'")

finally:
    time.sleep(2)
    driver.quit()
