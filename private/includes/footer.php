                </main>
            </div><!-- /row -->
        </div><!-- /container-fluid -->

        <footer class="text-center text-muted py-2" style="font-size:0.75em;border-top:1px solid #dee2e6;background:#f8f9fa;">
            <?= APP_COPYRIGHT ?> &mdash; <?= APP_NAME ?> v<?= APP_VERSION ?>
        </footer>

<!-- Bootstrap Toast container -->
<?php
$_toastMsg  = '';
$_toastType = 'success';
if (!empty($_SESSION['toast'])) {
    $_toastMsg  = $_SESSION['toast']['msg']  ?? '';
    $_toastType = $_SESSION['toast']['type'] ?? 'success';
    unset($_SESSION['toast']);
}
?>
<?php if ($_toastMsg): ?>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index:9999;">
    <div id="appToast" class="toast align-items-center text-bg-<?= $_toastType ?> border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body fw-semibold">
                <?php if ($_toastType === 'success'): ?>
                    <i class="fa-solid fa-circle-check me-2"></i>
                <?php else: ?>
                    <i class="fa-solid fa-circle-xmark me-2"></i>
                <?php endif; ?>
                <?= htmlspecialchars($_toastMsg) ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- jQuery -->
<script src="<?= APP_BASE ?>/assets/jquery/jquery.min.js"></script>

<!-- DataTables JS -->
<script src="<?= APP_BASE ?>/assets/datatables/js/dataTables.min.js"></script>

<!-- Bootstrap JS -->
<script src="<?= APP_BASE ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript partilhado -->
<script src="<?= APP_BASE ?>/assets/js/1241446.js"></script>

<!-- Bootstrap Tooltips + Toasts init -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Inicializar todos os tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
        new bootstrap.Tooltip(el);
    });
    // Auto-dismiss toast após 4 segundos
    var toastEl = document.getElementById('appToast');
    if (toastEl) {
        setTimeout(function () {
            bootstrap.Toast.getOrCreateInstance(toastEl).hide();
        }, 4000);
    }
});
</script>

<?php if (!empty($scriptsExtra)): ?>
    <?= $scriptsExtra ?>
<?php endif; ?>

</body>
</html>
