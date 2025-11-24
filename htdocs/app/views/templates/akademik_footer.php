                <div class="modal fade" id="confirmCredentialModal" tabindex="-1" aria-labelledby="confirmCredentialModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmCredentialModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda harus memasukkan password Admin untuk melanjutkan tindakan ini (Tambah/Ubah/Hapus).</p>
                                <div class="mb-3">
                                    <label for="adminPassword" class="form-label">Password Admin</label>
                                    <input type="password" class="form-control" id="adminPassword">
                                    <div id="passwordError" class="text-danger mt-2" style="display:none;"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" id="confirmActionButton">Lanjutkan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="bg-info mt-auto"> 
                <div class="container py-3">
                    <div class="copyright text-black text-center my-auto">
                        <span> <b> Copyright &copy; 10523204-MUHAMMAD-IRFAN-IS-5 </b> </span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script>
        const BASEURL = "<?= BASEURL; ?>";
        const USER_ROLE = "<?= $_SESSION['role']; ?>";
    </script>
    <script src="<?= BASEURL; ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= BASEURL; ?>/js/bootstrap.js"></script>
    <script src="<?= BASEURL; ?>/js/script.js"></script>
</body>
</html>
