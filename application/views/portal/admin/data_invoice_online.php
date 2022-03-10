<style>
    .btn-light {
        font-size: 12px
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <h2>Periode Summary Invoice</h2>
        <h5>Online Lesson</h5>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-12 pt-3">
                <a href="<?= site_url() ?>portal/invoice" class="btn ml-1 mr-1 pl-4 pr-4 btn-light">
                    Invoice Per Parent
                </a>
                |
                <span class="mr-1 pb-2" style="border-bottom:2px solid #62A8D6">
                    Summary Online Lesson
                </span>
                |
                <a href="<?= site_url() ?>portal/invoice/offline" class="btn ml-1 mr-1 pl-4 pr-4 btn-light">
                    Summary Offline Lesson
                </a>

            </div>
            <div id="table_offline" class="col-lg-12 col-12 mt-4" style="">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-striped table-white" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Periode</th>
                                <th>Summary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-center">
                                    No Data Available
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            'columnDefs': [{
                'targets': [0, 1, 2, 3, ], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }],
        });
    });
</script>