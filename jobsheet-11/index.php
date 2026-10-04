<?php
$page_title = "Beranda";

include __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/koneksi.php';

/*
|--------------------------------------------------------------------------
| Data Dashboard
|--------------------------------------------------------------------------
*/

$totalBuku = (int) $pdo
    ->query("SELECT COUNT(*) FROM buku")
    ->fetchColumn();

$totalAnggota = (int) $pdo
    ->query("SELECT COUNT(*) FROM anggota")
    ->fetchColumn();

/*
|--------------------------------------------------------------------------
| Untuk sementara jumlah peminjaman masih 0.
| Nantinya bisa diganti dengan query tabel peminjaman.
|--------------------------------------------------------------------------
*/
$totalDipinjam = 0;

/*
|--------------------------------------------------------------------------
| Nama user
|--------------------------------------------------------------------------
| htmlspecialchars digunakan untuk mencegah XSS apabila nama berasal
| dari session yang sebelumnya diambil dari input/database.
|--------------------------------------------------------------------------
*/
$namaUser = htmlspecialchars(
    $_SESSION['nama'] ?? 'Pengguna',
    ENT_QUOTES,
    'UTF-8'
);
?>

<main class="dashboard">

    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="hero-dashboard">

        <div class="hero-content">

            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                Sistem Perpustakaan Mini
            </div>

            <h2>
                Selamat datang,
                <span><?= $namaUser; ?></span>.
            </h2>

            <p>
                Kelola koleksi buku dan anggota perpustakaan
                dengan lebih sederhana, cepat, dan terorganisir.
            </p>

            <div class="hero-actions">

                <a href="buku/list.php" class="btn-primary">
                    Lihat Koleksi Buku
                    <span aria-hidden="true">→</span>
                </a>

                <a href="anggota/list.php" class="btn-secondary">
                    Kelola Anggota
                </a>

            </div>

        </div>

        <div class="hero-decoration" aria-hidden="true">

            <div class="hero-book">

                <div class="book-cover">
                    <span>LIBRARY</span>
                    <strong>MINI</strong>
                </div>

                <div class="book-page"></div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         STATISTIK
    ====================================================== -->

    <section class="dashboard-section">

        <div class="section-heading">

            <div>
                <span class="section-eyebrow">
                    OVERVIEW
                </span>

                <h2>
                    Ringkasan Perpustakaan
                </h2>
            </div>

            <span class="section-description">
                Data saat ini
            </span>

        </div>


        <div class="dashboard-stats">

            <!-- Total Buku -->

            <article class="dashboard-stat">

                <div class="stat-top">

                    <div class="stat-icon stat-icon-blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            aria-hidden="true">
                            <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5V5.5Z" />
                            <path d="M4 5.5v16" />
                            <path d="M8 7h8" />
                            <path d="M8 11h8" />
                        </svg>
                    </div>

                    <span class="stat-label">
                        Koleksi
                    </span>

                </div>

                <div class="stat-value">
                    <?= number_format($totalBuku); ?>
                </div>

                <div class="stat-name">
                    Total Buku
                </div>

            </article>


            <!-- Total Anggota -->

            <article class="dashboard-stat">

                <div class="stat-top">

                    <div class="stat-icon stat-icon-purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            aria-hidden="true">
                            <circle cx="9" cy="8" r="3" />
                            <path d="M3 20a6 6 0 0 1 12 0" />
                            <path d="M16 11a3 3 0 1 0 0-6" />
                            <path d="M18 14a5 5 0 0 1 3 6" />
                        </svg>
                    </div>

                    <span class="stat-label">
                        Komunitas
                    </span>

                </div>

                <div class="stat-value">
                    <?= number_format($totalAnggota); ?>
                </div>

                <div class="stat-name">
                    Total Anggota
                </div>

            </article>


            <!-- Sedang Dipinjam -->

            <article class="dashboard-stat">

                <div class="stat-top">

                    <div class="stat-icon stat-icon-orange">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            aria-hidden="true">
                            <circle cx="12" cy="12" r="8.5" />
                            <path d="M12 7v5l3 2" />
                        </svg>
                    </div>

                    <span class="stat-label">
                        Aktivitas
                    </span>

                </div>

                <div class="stat-value">
                    <?= number_format($totalDipinjam); ?>
                </div>

                <div class="stat-name">
                    Sedang Dipinjam
                </div>

            </article>

        </div>

    </section>


    <!-- =====================================================
         QUICK ACTION
    ====================================================== -->

    <section class="dashboard-section">

        <div class="section-heading">

            <div>
                <span class="section-eyebrow">
                    QUICK ACTION
                </span>

                <h2>
                    Mau melakukan apa?
                </h2>
            </div>

        </div>


        <div class="quick-actions">

            <a href="buku/list.php" class="quick-card">

                <div class="quick-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5V5.5Z" />
                        <path d="M4 5.5v16" />
                    </svg>
                </div>

                <div class="quick-content">

                    <h3>
                        Kelola Buku
                    </h3>

                    <p>
                        Tambahkan, edit, dan lihat koleksi buku.
                    </p>

                </div>

                <span class="quick-arrow">
                    →
                </span>

            </a>


            <a href="anggota/list.php" class="quick-card">

                <div class="quick-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <circle cx="9" cy="8" r="3" />
                        <path d="M3 20a6 6 0 0 1 12 0" />
                        <path d="M16 11a3 3 0 1 0 0-6" />
                    </svg>
                </div>

                <div class="quick-content">

                    <h3>
                        Kelola Anggota
                    </h3>

                    <p>
                        Kelola data anggota perpustakaan.
                    </p>

                </div>

                <span class="quick-arrow">
                    →
                </span>

            </a>


            <a href="peminjaman.php" class="quick-card">

                <div class="quick-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M6 3h12v18H6z" />
                        <path d="M9 7h6" />
                        <path d="M9 11h6" />
                        <path d="M9 15h4" />
                    </svg>
                </div>

                <div class="quick-content">

                    <h3>
                        Peminjaman
                    </h3>

                    <p>
                        Kelola aktivitas peminjaman buku.
                    </p>

                </div>

                <span class="quick-arrow">
                    →
                </span>

            </a>

        </div>

    </section>


    <!-- =====================================================
         INFO
    ====================================================== -->

    <section class="library-info">

        <div class="library-info-content">

            <span class="section-eyebrow">
                PERPUSTAKAAN
            </span>

            <h2>
                Semua koleksi,
                <br>
                satu tempat.
            </h2>

            <p>
                Sistem Perpustakaan Mini membantu mengelola
                informasi buku dan anggota secara terstruktur
                sehingga aktivitas perpustakaan menjadi lebih
                mudah dipantau.
            </p>

        </div>


        <div class="library-info-mark" aria-hidden="true">

            <span>LIB</span>

        </div>

    </section>

</main>


<style>
    /* =========================================================
   DASHBOARD
========================================================= */

    .dashboard {
        padding-top: clamp(1.5rem, 4vw, 3rem);
    }


    /* =========================================================
   HERO
========================================================= */

    .hero-dashboard {
        position: relative;

        min-height: 400px;

        display: flex;

        align-items: center;

        overflow: hidden;

        background:
            linear-gradient(135deg,
                #ffffff 0%,
                #f7f8fc 55%,
                #eef5ff 100%);

        border-radius: 28px;

        padding: clamp(2rem, 6vw, 4rem);

        margin-bottom: 1.5rem;

        border: 1px solid rgba(0, 0, 0, 0.04);

        box-shadow:
            0 2px 8px rgba(0, 0, 0, 0.03),
            0 20px 60px rgba(0, 0, 0, 0.06);
    }

    .hero-content {
        position: relative;

        z-index: 2;

        max-width: 650px;
    }

    .hero-badge {
        display: inline-flex;

        align-items: center;

        gap: 0.5rem;

        padding: 0.45rem 0.8rem;

        margin-bottom: 1.25rem;

        border-radius: 999px;

        background: rgba(0, 113, 227, 0.08);

        color: #0071e3;

        font-size: 0.75rem;

        font-weight: 600;

        letter-spacing: 0.02em;
    }

    .hero-badge-dot {
        width: 7px;

        height: 7px;

        border-radius: 50%;

        background: #34c759;

        box-shadow:
            0 0 0 4px rgba(52, 199, 89, 0.12);
    }

    .hero-dashboard h2 {
        max-width: 700px;

        font-size: clamp(2rem, 5vw, 4rem);

        line-height: 1.05;

        letter-spacing: -0.055em;

        font-weight: 700;

        color: #1d1d1f;

        margin-bottom: 1.25rem;
    }

    .hero-dashboard h2 span {
        color: #0071e3;
    }

    .hero-dashboard p {
        max-width: 570px;

        color: #6e6e73;

        font-size: clamp(0.95rem, 2vw, 1.1rem);

        line-height: 1.7;

        margin-bottom: 2rem;
    }

    .hero-actions {
        display: flex;

        align-items: center;

        flex-wrap: wrap;

        gap: 0.75rem;
    }

    .btn-primary,
    .btn-secondary {
        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 0.65rem;

        min-height: 44px;

        padding: 0.7rem 1.1rem;

        border-radius: 999px;

        font-size: 0.9rem;

        font-weight: 500;

        transition:
            transform 0.2s ease,
            background 0.2s ease,
            box-shadow 0.2s ease;
    }

    .btn-primary {
        background: #0071e3;

        color: #ffffff;

        box-shadow:
            0 5px 16px rgba(0, 113, 227, 0.2);
    }

    .btn-primary:hover {
        color: #ffffff;

        background: #0077ed;

        transform: translateY(-1px);

        box-shadow:
            0 8px 20px rgba(0, 113, 227, 0.25);
    }

    .btn-secondary {
        background: rgba(0, 0, 0, 0.05);

        color: #1d1d1f;
    }

    .btn-secondary:hover {
        color: #1d1d1f;

        background: rgba(0, 0, 0, 0.09);
    }


    /* =========================================================
   HERO BOOK DECORATION
========================================================= */

    .hero-decoration {
        position: absolute;

        right: 5%;

        top: 50%;

        transform: translateY(-50%);

        width: 280px;

        height: 280px;

        display: flex;

        align-items: center;

        justify-content: center;

        opacity: 0.95;
    }

    .hero-decoration::before {
        content: "";

        position: absolute;

        width: 240px;

        height: 240px;

        border-radius: 50%;

        background:
            linear-gradient(135deg,
                rgba(0, 113, 227, 0.08),
                rgba(88, 86, 214, 0.08));
    }

    .hero-book {
        position: relative;

        width: 130px;

        height: 175px;

        transform:
            perspective(700px) rotateY(-18deg) rotateZ(-5deg);

        filter:
            drop-shadow(15px 20px 20px rgba(0, 0, 0, 0.15));
    }

    .book-cover {
        position: absolute;

        inset: 0;

        display: flex;

        flex-direction: column;

        justify-content: center;

        align-items: center;

        gap: 0.4rem;

        border-radius: 5px 10px 10px 5px;

        background:
            linear-gradient(145deg,
                #0071e3,
                #5856d6);

        color: #ffffff;

        box-shadow:
            inset -5px 0 rgba(255, 255, 255, 0.08);
    }

    .book-cover span {
        font-size: 0.5rem;

        letter-spacing: 0.15em;

        opacity: 0.75;
    }

    .book-cover strong {
        font-size: 1.3rem;

        letter-spacing: -0.05em;
    }

    .book-page {
        position: absolute;

        right: -7px;

        top: 5px;

        width: 12px;

        height: calc(100% - 10px);

        border-radius: 0 7px 7px 0;

        background:
            repeating-linear-gradient(to bottom,
                #ffffff 0,
                #ffffff 3px,
                #e5e5e7 4px);
    }


    /* =========================================================
   DASHBOARD SECTION
========================================================= */

    .dashboard-section {
        background: #ffffff;

        border-radius: 24px;

        padding: clamp(1.25rem, 4vw, 2rem);

        margin-bottom: 1.5rem;

        border: 1px solid rgba(0, 0, 0, 0.04);

        box-shadow:
            0 2px 8px rgba(0, 0, 0, 0.03),
            0 12px 32px rgba(0, 0, 0, 0.04);
    }

    .section-heading {
        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 1rem;

        margin-bottom: 1.5rem;
    }

    .section-eyebrow {
        display: block;

        color: #86868b;

        font-size: 0.7rem;

        font-weight: 600;

        letter-spacing: 0.12em;

        margin-bottom: 0.35rem;
    }

    .section-heading h2 {
        margin: 0;

        font-size: clamp(1.2rem, 3vw, 1.5rem);

        letter-spacing: -0.035em;

        color: #1d1d1f;
    }

    .section-description {
        color: #86868b;

        font-size: 0.8rem;
    }


    /* =========================================================
   STATISTICS
========================================================= */

    .dashboard-stats {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 1rem;
    }

    .dashboard-stat {
        position: relative;

        min-width: 0;

        padding: 1.25rem;

        background: #f5f5f7;

        border-radius: 18px;

        border: 1px solid rgba(0, 0, 0, 0.025);

        overflow: hidden;

        transition:
            transform 0.2s ease,
            background 0.2s ease;
    }

    .dashboard-stat:hover {
        transform: translateY(-3px);

        background: #f0f0f2;
    }

    .stat-top {
        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 1rem;

        margin-bottom: 1.25rem;
    }

    .stat-icon {
        width: 42px;

        height: 42px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 12px;
    }

    .stat-icon svg {
        width: 21px;

        height: 21px;
    }

    .stat-icon-blue {
        color: #0071e3;

        background: rgba(0, 113, 227, 0.1);
    }

    .stat-icon-purple {
        color: #5856d6;

        background: rgba(88, 86, 214, 0.1);
    }

    .stat-icon-orange {
        color: #ff9f0a;

        background: rgba(255, 159, 10, 0.1);
    }

    .stat-label {
        color: #86868b;

        font-size: 0.72rem;

        font-weight: 500;
    }

    .stat-value {
        color: #1d1d1f;

        font-size: clamp(1.8rem, 4vw, 2.4rem);

        line-height: 1;

        font-weight: 700;

        letter-spacing: -0.055em;

        margin-bottom: 0.4rem;
    }

    .stat-name {
        color: #6e6e73;

        font-size: 0.82rem;
    }


    /* =========================================================
   QUICK ACTIONS
========================================================= */

    .quick-actions {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 0.75rem;
    }

    .quick-card {
        display: flex;

        align-items: center;

        gap: 1rem;

        min-width: 0;

        padding: 1rem;

        border-radius: 16px;

        background: #f5f5f7;

        color: #1d1d1f;

        border: 1px solid rgba(0, 0, 0, 0.025);

        transition:
            transform 0.2s ease,
            background 0.2s ease;
    }

    .quick-card:hover {
        color: #1d1d1f;

        background: #eeeeef;

        transform: translateY(-2px);
    }

    .quick-icon {
        flex: 0 0 40px;

        width: 40px;

        height: 40px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 11px;

        background: #ffffff;

        color: #0071e3;
    }

    .quick-icon svg {
        width: 20px;

        height: 20px;
    }

    .quick-content {
        min-width: 0;

        flex: 1;
    }

    .quick-content h3 {
        font-size: 0.9rem;

        font-weight: 600;

        margin-bottom: 0.15rem;
    }

    .quick-content p {
        color: #86868b;

        font-size: 0.72rem;

        line-height: 1.4;

        overflow-wrap: anywhere;
    }

    .quick-arrow {
        color: #86868b;

        font-size: 1.1rem;

        transition:
            transform 0.2s ease,
            color 0.2s ease;
    }

    .quick-card:hover .quick-arrow {
        color: #0071e3;

        transform: translateX(3px);
    }


    /* =========================================================
   LIBRARY INFO
========================================================= */

    .library-info {
        position: relative;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 2rem;

        overflow: hidden;

        min-height: 250px;

        padding: clamp(2rem, 5vw, 3rem);

        border-radius: 24px;

        background:
            linear-gradient(135deg,
                #1d1d1f,
                #2c2c2e);

        color: #ffffff;

        box-shadow:
            0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .library-info-content {
        position: relative;

        z-index: 2;

        max-width: 600px;
    }

    .library-info .section-eyebrow {
        color: #98989d;
    }

    .library-info h2 {
        margin-bottom: 1rem;

        color: #ffffff;

        font-size: clamp(1.8rem, 4vw, 2.8rem);

        line-height: 1.05;

        letter-spacing: -0.05em;
    }

    .library-info p {
        max-width: 550px;

        color: #a1a1a6;

        font-size: 0.9rem;

        line-height: 1.7;
    }

    .library-info-mark {
        position: absolute;

        right: 5%;

        width: 190px;

        height: 190px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        border: 1px solid rgba(255, 255, 255, 0.1);

        color: rgba(255, 255, 255, 0.12);

        font-size: 2rem;

        font-weight: 700;

        letter-spacing: -0.05em;
    }

    .library-info-mark::before,
    .library-info-mark::after {
        content: "";

        position: absolute;

        border: 1px solid rgba(255, 255, 255, 0.06);

        border-radius: 50%;
    }

    .library-info-mark::before {
        width: 140px;

        height: 140px;
    }

    .library-info-mark::after {
        width: 90px;

        height: 90px;
    }


    /* =========================================================
   DARK MODE
========================================================= */

    @media (prefers-color-scheme: dark) {

        .hero-dashboard {
            background:
                linear-gradient(135deg,
                    #1c1c1e,
                    #1c1c1e 55%,
                    #111b2b);

            border-color: rgba(255, 255, 255, 0.06);

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.3),
                0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .hero-dashboard h2 {
            color: #f5f5f7;
        }

        .hero-dashboard p {
            color: #98989d;
        }

        .hero-badge {
            background: rgba(41, 151, 255, 0.12);

            color: #2997ff;
        }

        .btn-secondary {
            background: #2c2c2e;

            color: #f5f5f7;
        }

        .btn-secondary:hover {
            background: #3a3a3c;

            color: #ffffff;
        }

        .dashboard-section {
            background: #1c1c1e;

            border-color: rgba(255, 255, 255, 0.06);

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.25),
                0 12px 32px rgba(0, 0, 0, 0.25);
        }

        .section-heading h2 {
            color: #f5f5f7;
        }

        .dashboard-stat {
            background: #2c2c2e;

            border-color: rgba(255, 255, 255, 0.04);
        }

        .dashboard-stat:hover {
            background: #3a3a3c;
        }

        .stat-value {
            color: #f5f5f7;
        }

        .stat-name {
            color: #98989d;
        }

        .quick-card {
            background: #2c2c2e;

            color: #f5f5f7;

            border-color: rgba(255, 255, 255, 0.04);
        }

        .quick-card:hover {
            background: #3a3a3c;

            color: #ffffff;
        }

        .quick-icon {
            background: #1c1c1e;

            color: #2997ff;
        }

        .quick-content h3 {
            color: #f5f5f7;
        }

        .quick-content p {
            color: #98989d;
        }

        .library-info {
            background:
                linear-gradient(135deg,
                    #000000,
                    #1c1c1e);

            border: 1px solid rgba(255, 255, 255, 0.06);
        }
    }


    /* =========================================================
   TABLET
========================================================= */

    @media (max-width: 900px) {

        .hero-decoration {
            right: -40px;

            transform:
                translateY(-50%) scale(0.8);

            opacity: 0.6;
        }

        .dashboard-stats {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

        .quick-actions {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

        .quick-card:last-child {
            grid-column: span 2;
        }
    }


    /* =========================================================
   MOBILE
========================================================= */

    @media (max-width: 600px) {

        .dashboard {
            padding-top: 1rem;
        }

        .hero-dashboard {
            min-height: auto;

            padding: 1.5rem;

            border-radius: 20px;
        }

        .hero-dashboard h2 {
            font-size: clamp(2rem, 10vw, 3rem);
        }

        .hero-dashboard p {
            font-size: 0.9rem;

            line-height: 1.6;
        }

        .hero-actions {
            flex-direction: column;

            align-items: stretch;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
        }

        .hero-decoration {
            display: none;
        }

        .dashboard-section {
            padding: 1.25rem;

            border-radius: 18px;
        }

        .section-heading {
            align-items: flex-start;

            flex-direction: column;

            margin-bottom: 1rem;
        }

        .dashboard-stats {
            grid-template-columns: 1fr;

            gap: 0.75rem;
        }

        .dashboard-stat {
            padding: 1rem;
        }

        .quick-actions {
            grid-template-columns: 1fr;

            gap: 0.65rem;
        }

        .quick-card:last-child {
            grid-column: auto;
        }

        .library-info {
            min-height: auto;

            padding: 1.5rem;

            border-radius: 18px;
        }

        .library-info-mark {
            right: -70px;

            opacity: 0.5;

            transform: scale(0.8);
        }

        .library-info p {
            font-size: 0.82rem;

            max-width: 90%;
        }
    }


    /* =========================================================
   SMALL PHONE
========================================================= */

    @media (max-width: 380px) {

        .hero-dashboard {
            padding: 1.25rem;
        }

        .hero-dashboard h2 {
            font-size: 1.9rem;
        }

        .dashboard-section {
            padding: 1rem;
        }

        .stat-icon {
            width: 38px;

            height: 38px;
        }

        .stat-value {
            font-size: 1.7rem;
        }

        .quick-card {
            padding: 0.85rem;
        }

        .quick-icon {
            flex-basis: 36px;

            width: 36px;

            height: 36px;
        }
    }
</style>


<?php
include __DIR__ . '/includes/footer.php';
?>