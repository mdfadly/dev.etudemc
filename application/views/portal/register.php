<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title ?></title>

    <meta name="title" property="title" data-react-helmet="true" content="<?= $title ?>">
    <meta data-react-helmet="true" content="<?= $title ?>" name="og:title" property="og:title">
    <meta data-react-helmet="true" content="<?= $description ?>" name="description" property="description">
    <meta data-react-helmet="true" content="<?= $description ?>" name="og:description" property="og:description">

    <meta content="<?= base_url() ?>assets/img/logo-1.png" name="og:image" property="og:image">
    <meta content="Etude" name="og:site_name" property="og:site_name">
    <meta content="website" name="og:type" property="og:type">

    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/img/icon-etude.png">

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/login.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>

<body>
    <style>
        .avatar {
            border-radius: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cover {
            text-align: center;
        }

        .cover-img {
            width: 150px;
            height: 150px;
            display: block;
            margin: 0 auto;
        }

        .hiden {
            display: none;
        }
    </style>
    <div class="head-regis" style="margin-top:30px">
        <img width="200px" src="<?= base_url() ?>assets/img/logo.png" alt="logo-etude">
        <div class="signup-link">
            Have an account? <a href="<?= site_url() ?>portal">Login now</a>
        </div>
    </div>
    <div class="wrapper">
        <div class="title-text">
            <div class="title">
                Sign Up
            </div>
        </div>
        <div class="form-container">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('warning') ?>
                </div>
            <?php endif; ?>
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Teacher</label>
                <label for="signup" class="slide signup">Parent/Student</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form id="form-login" enctype="multipart/form-data" action="<?= site_url('portal/C_Portal/addDataRegister'); ?>" method="POST" class="login">
                    <br />
                    <h5 style="font-weight:bold">ETUDE ACCOUNT</h5>
                    <div class="form-group row">
                        <label for="username" class="col-3 col-lg-3 pt-lg-2 col-form-label">Username</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" minlength="3" maxlength="15" class="form-control regist-form" required name="username" id="username">
                            <small id="check-username" class="form-text"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-3 col-lg-3 pt-lg-2 col-form-label">Password</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="password" minlength="8" maxlength="12" class="form-control regist-form pwd" required name="password" id="inputPassword">
                        </div>
                    </div>
                    <hr />
                    <div class="form-group text-center">
                        <div class="cover-img" id="divImg">
                            <img src="<?= site_url() ?>assets/img/avatar.png" class="avatar rounded-circle img-thumbnail" alt="avatar">
                        </div>
                        <p>Upload your profile picture</p>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-3 col-form-label"></label>
                        <div class="col-6 col-lg-8">
                            <input type="file" required name="pict" class="form-control-file center-block file-upload" style="text-align: center; margin: auto; font-size:12px">
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="name" class="col-3 col-lg-3 pt-lg-2 col-form-label">Name</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="name" id="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dob" class="col-3 col-lg-3 pt-lg-2 col-form-label">DOB</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="dob" id="dob">
                            <small id="emailHelp" class="form-text text-muted">(Ex: Jakarta, 20 Maret 1990)</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="instrument" class="col-3 col-lg-3 pt-lg-2 col-form-label">Instrument</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" maxlength="30" class="form-control regist-form" required name="instrument" id="instrument">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="credentials" class="col-3 col-lg-3 pt-lg-2 col-form-label">Credentials</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="credentials" id="credentials">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-6 col-lg-3 pt-lg-2 col-form-label">Phone No.</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="phone" id="phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-3 col-lg-3 pt-lg-2 col-form-label">Email</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="email" class="form-control regist-form" required name="email" id="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ktp" class="col-3 col-lg-3 pt-lg-2 col-form-label">Identity Card</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="file" class="form-control-file regist-form" required name="ktp" id="ktp">
                        </div>
                    </div>

                    <hr />
                    <h5 style="font-weight:bold">ADDRESS</h5>
                    <div class="form-group form-check">
                        <input type="checkbox" name="status_country" value="1" checked class="form-check-input" id="status_country">
                        <label class="form-check-label" for="status_country">From Indonesia</label>
                        <input type="hidden" id="kat" name="kat" value="1">
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-3 col-lg-3 pt-lg-2 col-form-label">Street</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <textarea class="form-control regist-form" rows="4" required name="address" id="address"></textarea>
                            <!-- <input type="text" class="form-control regist-form" required name="address" id="address"> -->
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Sub District</label>
                            <input type="text" name="kelurahan" required class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">District</label>
                            <input type="text" name="kecamatan" required class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputCity">City</label>
                            <input type="text" name="kota" required class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="inputCity">Province</label>
                            <input type="text" name="provinsi" required class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="inputZip">Postal Code</label>
                            <input type="text" name="zip" required class="form-control regist-form">
                        </div>
                        <div id="check_country" class="form-group col-lg-6 hiden">
                            <label for="inputCity">Country</label>
                            <input id="negara" type="text" name="negara" value="Indonesia" required class="form-control regist-form">
                        </div>
                    </div>
                    <hr />
                    <h5 style="font-weight:bold">BANK ACCOUNT</h5>
                    <div class="form-group row">
                        <label for="bank" class="col-3 col-lg-3 pt-lg-2 col-form-label">Bank</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="bank" id="bank">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name_rek_teacher" class="col-3 col-lg-3 pt-lg-2 col-form-label">Name Bank Account</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="name_rek_teacher" id="name_rek_teacher">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="norek" class="col-6 col-lg-3 pt-lg-2 col-form-label">Account No.</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="norek" id="norek">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="iban_rek_teacher" class="col-3 col-lg-3 pt-lg-2 col-form-label">IBAN</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="iban_rek_teacher" id="iban_rek_teacher">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="swift_rek_teacher" class="col-3 col-lg-3 pt-lg-2 col-form-label">SWIFT</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="swift_rek_teacher" id="swift_rek_teacher">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 col-lg-12">
                            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                <form id="form-signup" enctype="multipart/form-data" action="<?= site_url('portal/C_Admin/add_data_student2'); ?>" method="POST" class="signup hiden">
                    <input type="hidden" class="form-control regist-form" required value="register_signup" name="from_form" id="from_form">
                    <br />
                    <h5 style="font-weight:bold">ETUDE ACCOUNT</h5>
                    <div class="form-group row">
                        <label for="username_parent" class="col-3 col-lg-3 pt-lg-2 col-form-label">Username</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" minlength="3" maxlength="15" class="form-control regist-form" required name="username_parent" id="username_parent">
                            <small id="check-username-parent" class="form-text"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword_parent" class="col-3 col-lg-3 pt-lg-2 col-form-label">Password</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="password" minlength="8" maxlength="12" class="form-control regist-form pwd" required name="password_parent" id="inputPassword_parent">
                        </div>
                    </div>
                    <h5 style="font-weight:bold">Parent / Person in Charge</h5>
                    <div class="form-group row pt-3">
                        <label for="parent_student" class="col-3 col-lg-3 pt-lg-2 col-form-label">Name</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="parent_student" id="parent_student">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email_parent_1" class="col-3 col-lg-3 pt-lg-2 col-form-label">Email</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="email" class="form-control regist-form" required name="email_parent_1" id="email_parent_1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ig_parent_1" class="col-3 col-lg-3 pt-lg-2 col-form-label">Instagram</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="ig_parent_1" id="ig_parent_1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_parent_1" class="col-3 col-lg-3 pt-lg-2 col-form-label">Phone No.</label>
                        <span class="col-1 col-lg-1 pt-lg-2"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="phone_parent_1" id="phone_parent_1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_parent_2" class="col-3 col-lg-3 col-form-label">Alternative Phone No.</label>
                        <span class="col-1 col-lg-1"> : </span>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control regist-form" required name="phone_parent_2" id="phone_parent_2">
                            <small class="form-text text-muted">(Ex: housemate/babysitter/etc)</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address_parent">Address</label>
                        <textarea class="form-control regist-form" rows="4" required name="address_parent" id="address_parent"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="kelurahan_parent">Sub District</label>
                            <input type="text" id="kelurahan_parent" name="kelurahan_parent" required class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="kecamatan_parent">District</label>
                            <input type="text" name="kecamatan_parent" id="kecamatan_parent" required class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="kota_parent">City</label>
                            <input type="text" name="kota_parent" id="kota_parent" required class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="provinsi_parent">Province</label>
                            <input type="text" name="provinsi_parent" id="provinsi_parent" required class="form-control regist-form">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="zip_parent">Postal Code</label>
                            <input type="text" name="zip_parent" id="zip_parent" required class="form-control regist-form">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="country_parent">Country</label>
                            <input type="text" name="country_parent" id="country_parent" required class="form-control regist-form">
                        </div>
                    </div>
                    <hr />
                    <h5 style="font-weight:bold">Student</h5>
                    <div class="form-group text-center">
                        <div class="cover-img" id="divImg_student">
                            <img src="<?= site_url() ?>assets/img/avatar.png" class="avatar rounded-circle img-thumbnail" alt="avatar">
                        </div>
                        <p>Upload student picture</p>
                    </div>
                    <div class="form-group row">
                        <label for="pict_student1" class="col-3 col-form-label"></label>
                        <div class="col-6 col-lg-8">
                            <input type="file" required name="pict_student1" class="form-control-file center-block file-upload" style="text-align: center; margin: auto; font-size:12px">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name_student">Student Full Name</label>
                        <input type="text" class="form-control" id="name_student" required name="name_student1">
                    </div>
                    <div class="form-group">
                        <label for="nickname_student">Student Nick Name</label>
                        <input type="text" class="form-control" id="nickname_student" required name="nickname_student1">
                    </div>
                    <div class="form-group">
                        <label for="gender_student">Student Gender</label>
                        <select class="form-control select-form" style="width:100%;" id="gender_student1" name="gender_student1" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dob_student">Student Place - DOB</label>
                        <input type="text" class="form-control" id="dob_student" required name="dob_student1">
                        <small id="emailHelp" class="form-text text-muted">(Ex: Jakarta - 20 Maret 1990)</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="check_address" value="1" checked class="form-check-input" id="check_address">
                        <label class="form-check-label" for="check_address">
                            The address same as parent</label>
                    </div>
                    <div id="address_parent_same" class="hiden">
                        <div class="form-group">
                            <label for="address_student">Address</label>
                            <textarea class="form-control regist-form" rows="4" name="address_student" id="address_student"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="kelurahan">Sub District</label>
                                <input type="text" id="kelurahan" name="kelurahan" class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="kecamatan">District</label>
                                <input type="text" name="kecamatan" id="kecamatan" class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="kota">City</label>
                                <input type="text" name="kota" id="kota" class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="provinsi">Province</label>
                                <input type="text" name="provinsi" id="provinsi" class="form-control regist-form">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="inputZip">Postal Code</label>
                                <input type="text" name="zip" id="zip" class="form-control regist-form">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country" class="form-control regist-form">
                            </div>
                        </div>
                    </div>
                    <div id="new_student">

                    </div>

                    <input type="hidden" value="1" name="total_student" id="total_student">
                    <!-- <div class="form-group row">
                        <div class="col-12 col-lg-2">
                            <button type="button" class="add btn btn-info">Add</button>
                        </div>
                        <div class="col-12 col-lg-2">
                            <button type="button" class="remove btn btn-info">remove</button>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <div class="col-12 col-lg-12">
                            <button id="submit-parent" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/popper.js'); ?>" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
    <!-- Optional JavaScript -->
    <script>
        $(document).ready(function() {
            $('.add').on('click', add);
            $('.remove').on('click', remove);

            function add() {
                add_dob();
                add_school();
                add_instrument();
                var new_student_no = parseInt($('#total_student').val()) + 1;
                var new_input = "<input class='form-control mt-2' placeholder='Student name " + new_student_no + "...' name='name_student" + new_student_no + "' type='text' id='new_" + new_student_no + "'>";

                $('#new_student').append(new_input);

                $('#total_student').val(new_student_no);
            }

            function remove() {
                remove_dob();
                remove_school();
                remove_instrument();
                var last_student_no = $('#total_student').val();

                if (last_student_no > 1) {
                    $('#new_' + last_student_no).remove();
                    $('#total_student').val(last_student_no - 1);
                }
            }

            // $('.add_dob').on('click', add_dob);
            // $('.remove_dob').on('click', remove_dob);

            function add_dob() {
                var new_dob_no = parseInt($('#total_dob').val()) + 1;
                var new_input = "<input class='form-control mt-2' placeholder='DOB Student " + new_dob_no + "..' name='dob_student" + new_dob_no + "' type='text' id='new_" + new_dob_no + "'>";

                $('#new_dob').append(new_input);

                $('#total_dob').val(new_dob_no);
            }

            function remove_dob() {
                var last_dob_no = $('#total_dob').val();

                if (last_dob_no > 1) {
                    $('#new_' + last_dob_no).remove();
                    $('#total_dob').val(last_dob_no - 1);
                }
            }

            function add_school() {
                var new_school_no = parseInt($('#total_school').val()) + 1;
                var new_input = "<input class='form-control mt-2' placeholder='school Student " + new_school_no + "..' name='school_student" + new_school_no + "' type='text' id='new_" + new_school_no + "'>";

                $('#new_school').append(new_input);

                $('#total_school').val(new_school_no);
            }

            function remove_school() {
                var last_school_no = $('#total_school').val();

                if (last_school_no > 1) {
                    $('#new_' + last_school_no).remove();
                    $('#total_school').val(last_school_no - 1);
                }
            }

            function add_instrument() {
                var new_instrument_no = parseInt($('#total_instrument').val()) + 1;
                var new_input = "<input class='form-control mt-2' placeholder='instrument Student " + new_instrument_no + "..' name='instrument" + new_instrument_no + "' type='text' id='new_" + new_instrument_no + "'>";

                $('#new_instrument').append(new_input);

                $('#total_instrument').val(new_instrument_no);
            }

            function remove_instrument() {
                var last_instrument_no = $('#total_instrument').val();

                if (last_instrument_no > 1) {
                    $('#new_' + last_instrument_no).remove();
                    $('#total_instrument').val(last_instrument_no - 1);
                }
            }
        });
        var username = document.getElementById('username');
        username.addEventListener('keyup', function(e) {
            let val = e.target.value;
            $.ajax({
                url: "<?= base_url('portal/C_Portal/checkUsername') ?>",
                type: "POST",
                data: {
                    'username': val,
                    'from': 'teacher'
                },
                success: function(data) {
                    $("#check-username").html(data)
                }
            });
        })
        var username_parent = document.getElementById('username_parent');
        username_parent.addEventListener('keyup', function(e) {
            let val = e.target.value;
            $.ajax({
                url: "<?= base_url('portal/C_Portal/checkUsername') ?>",
                type: "POST",
                data: {
                    'username': val,
                    'from': 'parent'
                },
                success: function(data) {
                    $("#check-username-parent").html(data)
                }
            });
        })
        $("#check_address").on('click', function() {
            var value = $(this).val();
            if (value == 0) {
                document.getElementById("check_address").value = "1";
                document.getElementById("address_parent_same").classList.add("hiden");
            } else {
                document.getElementById("check_address").value = "0";
                document.getElementById("address_parent_same").classList.remove("hiden");

            }
        });
    </script>
    <script>
        $("#status_country").on('click', function() {
            var value = $(this).val();
            if (value == 0) {
                document.getElementById("status_country").value = "1";
                document.getElementById("check_country").classList.add("hiden");
                document.getElementById("negara").value = "Indonesia";
                document.getElementById("kat").value = "1";
            } else {
                document.getElementById("check_country").classList.remove("hiden");
                document.getElementById("negara").value = " ";
                document.getElementById("kat").value = "2";
                document.getElementById("status_country").value = "0";
            }

        });
        $(document).ready(function() {


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function() {
                readURL(this);
            });
        });
        $("#btn-eye").mousedown(function() {
                $('.iconEye').removeClass('fa-eye-slash');
                $('.iconEye').addClass('fa-eye');
                $(".pwd").replaceWith($('.pwd').clone().attr('type', 'text'));
            })
            .mouseup(function() {
                $('.iconEye').removeClass('fa-eye');
                $('.iconEye').addClass('fa-eye-slash');
                $(".pwd").replaceWith($('.pwd').clone().attr('type', 'password'));
            })
            .mouseout(function() {
                $('.iconEye').removeClass('fa-eye');
                $('.iconEye').addClass('fa-eye-slash');
                $(".pwd").replaceWith($('.pwd').clone().attr('type', 'password'));
            });

        $(document).ready(function() {
            var x = window.matchMedia("(max-width: 990px)");
            myFunction(x); // Call listener function at run time
            x.addListener(myFunction); // Attach listener function on state changes

            function myFunction(x) {
                if (x.matches) { // If media query matches
                    $('.head-login').addClass('text-center');
                } else {
                    $('.head-login').removeClass('text-center');
                }
            };
        });
    </script>
    <script>
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signUpForm = document.querySelector("form.signup");

        var formLogin = document.getElementById("form-login");
        var formSignup = document.getElementById("form-signup");

        signupBtn.onclick = (() => {
            loginForm.style.marginLeft = "-50%";
            formLogin.classList.add("hiden");
            formSignup.classList.remove("hiden");
            $("#username").val("");
            $("#check-username").html("");
            $('#submit').prop('disabled', false);
        });
        loginBtn.onclick = (() => {
            loginForm.style.marginLeft = "0%";
            formLogin.classList.remove("hiden");
            formSignup.classList.add("hiden");
            $("#username_parent").val("");
            $("#check-username-parent").html("");
            $('#submit-parent').prop('disabled', false);
        });
    </script>
</body>

</html>