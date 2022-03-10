<main class="page-content">
    <div class="container-fluid">
        <h2>Add Book</h2>
        <hr>
        <div class="row">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-12">
                <a href="<?= site_url() ?>portal/book/" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </div>

            <div class="col-lg-12 col-12 mt-4">
                <form action="<?= site_url('portal/C_Admin/add_data_book') ?>" method="POST">
                    <div class="form-group">
                        <label for="title">Book Title</label><br>
                        <input type="text" required class="form-control" id="title" required name="title">
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher</label><br>
                        <input type="text" required class="form-control" id="publisher" required name="publisher">
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="number" class="form-control" id="qty" required name="qty">
                    </div>
                    <div class="form-group">
                        <label for="distributor">Distributor</label>
                        <input type="text" class="form-control" id="distributor" required name="distributor">
                    </div>
                    <div class="form-group">
                        <label for="distributor_price">Distributor Price</label>
                        <!-- <input type="number" class="form-control" id="distributor_price" required name="distributor_price"> -->
                        <input type="text" class="form-control" id="rupiah" />
                        <input type="hidden" class="form-control" id="distributor_price" name="distributor_price">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('.select-form').select2();
    });
</script>
<script>
    var distributor_price = document.getElementById('distributor_price');
    var rupiah = document.getElementById('rupiah');
    var valuee = '';
    rupiah.addEventListener('keyup', function(e) {
        rupiah.value = formatRupiah(this.value);
        valuee = rupiah.value;
        distributor_price.value = valuee.split('.').join("");
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>