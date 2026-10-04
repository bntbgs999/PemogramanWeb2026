<?
$sudahLogin = isset($_SESSION['user_id']);
if (!$sudahLogin) {
    header('Location: ../auth/login.php');
    exit;
}
?>
</main>

<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <div>
                <strong>SIMPUS-Mini</strong>
                <span>Sistem Perpustakaan Mini</span>
            </div>
        </div>

        <div class="footer-meta">
            <span>&copy; 2026 SIMPUS-Mini</span>
            <span class="footer-dot">•</span>
            <span>Jobsheet 9</span>
        </div>
    </div>
</footer>

<script src="<?php echo $base; ?>assets/js/app.js"></script>

<?php if (!empty($extra_scripts)): ?>
    <?php foreach ($extra_scripts as $src): ?>
        <script src="<?php echo htmlspecialchars($src, ENT_QUOTES, 'UTF-8'); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

</body>

</html>