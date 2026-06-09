                </main>
            </div><!-- /row -->
        </div><!-- /container-fluid -->

        <footer class="text-center text-muted py-2" style="font-size:0.75em;border-top:1px solid #dee2e6;background:#f8f9fa;">
            <?= APP_COPYRIGHT ?> &mdash; <?= APP_NAME ?> v<?= APP_VERSION ?>
        </footer>

<!-- jQuery -->
<script src="<?= APP_BASE ?>/assets/jquery/jquery.min.js"></script>

<!-- DataTables JS -->
<script src="<?= APP_BASE ?>/assets/datatables/js/dataTables.min.js"></script>

<!-- Bootstrap JS -->
<script src="<?= APP_BASE ?>/assets/bootstrap/js/bootstrap.bundle.min.js" defer></script>

<!-- JavaScript partilhado -->
<script src="<?= APP_BASE ?>/assets/js/1241446.js" defer></script>

<?php if (!empty($scriptsExtra)): ?>
    <?= $scriptsExtra ?>
<?php endif; ?>

</body>
</html>
