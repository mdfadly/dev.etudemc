<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Parent extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Portal');
        $this->load->model('M_Admin');
    }

    private function cekLogin()
    {
        if (!$this->session->userdata('login_user')) {
            redirect('portal/user-login');
        }
    }

    public function notfound()
    {
        $this->cekLogin();
        $title = "Dashboard | Welcome to Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description));
        $this->load->view('portal/parent/404');
        $this->load->view('portal/reuse/footer');
    }

    public function profile($username)
    {
        $this->cekLogin();
        $student = $this->M_Portal->get_student(" where username_parent = '$username'");
        $title = "Profile | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/profile', $student);
        $this->load->view('portal/reuse/footer');
    }

    public function offline_lesson()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));
        $title = "Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_offline');
        $this->load->view('portal/reuse/footer');
    }

    public function offline_lesson_list($id_student)
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));

        $title = "Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_offline_list', array('id_student' => $id_student));
        $this->load->view('portal/reuse/footer');
    }

    public function get_offline_lesson()
    {
        $this->cekLogin();
        $id_student = $_POST['id_student'];
        $this->get_ajax_offline_lesson2($id_student);
    }

    function get_ajax_offline_lesson2($id_student)
    {
        $this->cekLogin();
        $dbTable = "list_package_offline";
        $list = $this->M_Parent->get_datatables($dbTable, $id_student);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();

            $count_done = 0;
            $count_cancel = 0;
            $count_ongoing = 0;
            $data_schedule = $this->M_Parent->getData_schedule_package_offline(null, $item->id_list_package_offline);
            foreach ($data_schedule as $ds) {
                if ($ds['status'] == '1' || ($ds['status'] == '3' && $ds['date_update_cancel'] == null) || $ds['status'] == '7' || $ds['status'] == '5') {
                    $count_ongoing += 1;
                } else if ($ds['status'] == '2' || ($ds['status'] == '3' && $ds['date_update_cancel'] != null)) {
                    $count_done += 1;
                } else if ($ds['status'] == '3' && $ds['date_update_cancel'] == null) {
                    $count_cancel += 1;
                }
            }

            $row[] = $item->no_transaksi_package_offline;
            $row[] = $item->name_teacher;

            $startdate = date_create(substr($item->created_at, 0, 10));
            $tgl_awal = date_format($startdate, "d/m/Y");

            $enddate = date_create(substr($item->end_at, 0, 10));
            $tgl_akhir = date_format($enddate, "d/m/Y");

            $today = date("Y-m-d");

            $row[] = $tgl_awal . " - " . $tgl_akhir;

            $status_pack = "";
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $status_pack = '<span class="badge badge-primary text-white">Choose The Date !</span>';
            } else {
                if (count($data_schedule) == $count_done) {
                    $status_pack = '<span class="badge badge-danger">Done</span>';
                } else if (($count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">2 pack more!</span>';
                } else if (($count_ongoing == 2 || $count_ongoing == 1) && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">1 pack more!</span>';
                } else {
                    $status_pack = '<span class="badge text-white" style="background-color:#00B050">On Going</span>';
                }
            }
            $row[] = $status_pack;
            // $row[] = $status_pack ." - ". $count_ongoing ." - " . $count_done ." - " . $count_cancel;
            // add html for action
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $row[] = '';
            } else {
                if (count($data_schedule) == $count_done) {
                    $row[] = '<a class="text-danger" href="' . site_url('portal/offline-lesson/calendar/' . $item->id_list_package_offline) . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else if (($count_ongoing == 2 || $count_ongoing == 1 || $count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                    $row[] = '<a class="text-warning" href="' . site_url('portal/offline-lesson/calendar/' . $item->id_list_package_offline) . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else {
                    $row[] = '<a href="' . site_url('portal/offline-lesson/calendar/' . $item->id_list_package_offline) . '" style="font-size:23px; color:#00B050"> <i class="fa fa-calendar"></i> </a><br>';
                }
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Parent->count_all($dbTable, $id_student),
            "recordsFiltered" => $this->M_Parent->count_filtered($dbTable, $id_student),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function offline_lesson_calendar($id_package)
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));

        $pack_online = $this->M_Teacher->getData_pack_offline($id_package);
        $schedule_online = $this->M_Teacher->getData_schedule_package_offline(null, $id_package);
        $count_package = [];
        foreach ($schedule_online as $so) {
            $count_package[] = $so['id_schedule_package_offline'];
        }
        $title = "Attendance Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_offline_calendar', array('pack_online' => $pack_online, 'count_package' => $count_package));
        $this->load->view('portal/reuse/footer');
    }

    public function load_package_offline($id_list_package_offline, $id_student)
    {
        $event_data = $this->M_Parent->fetch_all_package_offline($id_list_package_offline, $id_student);
        $z = 1;
        $x = 1;
        foreach ($event_data->result_array() as $row) {
            $title = '';
            $color = '';
            $temp_date = '';
            if ($row['status'] != 3) {
                if ($row['status'] == 1) {
                    $title = 'Undone';
                    $color = '#f0a500';
                }
                if ($row['status'] == 2) {
                    if (fmod($z++, 2) == 1) {
                        $title = 'Lesson ' . $x . ' a';
                    } else {
                        $title = 'Lesson ' . $x++ . ' b';
                    }
                    $color = '#fddb3a';
                }
                if ($row['status'] == 3) {
                    // $title = 'Cancel';
                    $color = '#ffffff';
                }
                if ($row['status'] == 4) {
                    $title = 'New Schedule';
                    $color = '#54a0ff';
                }
                if ($row['status'] == 5) {
                    $title = 'Late';
                    $color = '#FF5C58';
                }
                if ($row['status'] == 7) {
                    $title = 'No Lesson';
                    $color = '#D0CAB2';
                }
                $temp_date = $row['date_schedule'];
            }
            if ($row['status'] == 3 && $row['date_update_cancel'] != NULL) {
                $title = 'Reschedule';
                if (fmod($z++, 2) == 1) {
                    $title = 'Re - Lesson ' . $x . ' a';
                } else {
                    $title = 'Re - Lesson ' . $x++ . ' b';
                }
                $color = '#10ac84';
                $temp_date = $row['date_update_cancel'];
            }
            if ($row['status'] == 3 && $row['date_update_cancel'] == NULL) {
                $title = 'Cancel';
                $color = '#10ac84';
                $temp_date = $row['date_schedule'];
            }
            $data[] = array(
                'id' => $row['id_schedule_package_offline'],
                'allDay' => true,
                'stick' => true,
                'start' => $temp_date,
                'end' => $temp_date,
                'title' => $title,
                'date' => $temp_date,
                'id_list_package_offline' => $row['id_list_package_offline'],
                'color' => $color,
                'status' => $row['status']
            );
        }
        echo json_encode($data);
    }

    public function load_package($id_list_pack)
    {
        $event_data = $this->M_Parent->fetch_all_package($id_list_pack, $this->session->userdata('id'));
        // echo var_dump($event_data->result_array());
        // die();
        $z = 1;
        $x = 1;
        foreach ($event_data->result_array() as $row) {
            // echo $row['id_schedule_pack'];/
            // die();
            $title = '';
            $color = '';
            $temp_date = '';
            if ($row['status'] != 3) {
                if ($row['jenis'] == 1) {
                    if ($row['status'] == 1) {
                        $title = 'Undone';
                        $color = '#f0a500';
                    }
                    if ($row['status'] == 2) {
                        if (fmod($z++, 2) == 1) {
                            $title = 'Lesson ' . $x . ' a';
                        } else {
                            $title = 'Lesson ' . $x++ . ' b';
                        }
                        $color = '#fddb3a';
                    }
                    if ($row['status'] == 3) {
                        // $title = 'Cancel';
                        $color = '#ffffff';
                    }
                    if ($row['status'] == 4) {
                        $title = 'New Schedule';
                        $color = '#54a0ff';
                    }
                    if ($row['status'] == 5) {
                        $title = 'Late';
                        $color = '#FF5C58';
                    }
                    if ($row['status'] == 7) {
                        $title = 'No Lesson';
                        $color = '#D0CAB2';
                    }
                }
                if ($row['jenis'] == 2) {
                    if ($row['status'] == 1) {
                        $title = 'Undone';
                        $color = '#056676';
                    }
                    if ($row['status'] == 2) {
                        if (fmod($z++, 2) == 1) {
                            $title = 'Lesson ' . $x . ' a';
                        } else {
                            $title = 'Lesson ' . $x++ . ' b';
                        }
                        $color = '#5eaaa8';
                    }
                    if ($row['status'] == 3) {
                        // $title = 'Cancel';
                        $color = '#ffffff';
                    }
                    if ($row['status'] == 4) {
                        $title = 'New Schedule';
                        $color = '#54a0ff';
                    }
                    if ($row['status'] == 5) {
                        $title = 'Late';
                        $color = '#FF5C58';
                    }
                    if ($row['status'] == 7) {
                        $title = 'No Lesson';
                        $color = '#D0CAB2';
                    }
                }
                $temp_date = $row['date_schedule'];
            }
            if ($row['status'] == 3 && $row['date_update_cancel'] != NULL) {
                $title = 'Reschedule';
                if (fmod($z++, 2) == 1) {
                    $title = 'Re - Lesson ' . $x . ' a';
                } else {
                    $title = 'Re - Lesson ' . $x++ . ' b';
                }
                $color = '#10ac84';
                $temp_date = $row['date_update_cancel'];
            }
            if ($row['status'] == 3 && $row['date_update_cancel'] == NULL) {
                $title = 'Cancel';
                $color = '#10ac84';
                $temp_date = $row['date_schedule'];
            }
            $data[] = array(
                'id' => $row['id_schedule_pack'],
                'allDay' => true,
                'stick' => true,
                'start' => $temp_date,
                'end' => $temp_date,
                'title' => $title,
                'date' => $temp_date,
                'id_list_pack' => $row['id_list_pack'],
                'color' => $color,
                'jenis' => $row['jenis'],
                'status' => $row['status']
            );
        }
        echo json_encode($data);
    }

    public function online_pratical()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));
        $title = "Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_online');
        $this->load->view('portal/reuse/footer');
    }

    public function online_pratical_list($id_student)
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));

        $title = "Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_online_list', array('id_student' => $id_student));
        $this->load->view('portal/reuse/footer');
    }

    public function get_online_pratical()
    {
        // $this->cekLogin();
        // $id_student = $_POST['id_student'];
        // $jenis = $_POST['jenis'];
        $id_student = '1000011';
        $jenis = '1';

        $this->get_ajax_online_pratical($id_student, $jenis);
    }

    function get_ajax_online_pratical($id_student, $jenis)
    {
        // $this->cekLogin();
        $dbTable = "list_package";
        // $jenis = '1';
        $list = $this->M_Parent->get_datatables($dbTable, $id_student, null, $jenis);

        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            // $row[] = $no . ".";

            $count_done = 0;
            $count_cancel = 0;
            $count_ongoing = 0;
            $data_schedule = $this->M_Teacher->getData_schedule_package(null, $item->id_list_pack, null, null, $jenis);
            foreach ($data_schedule as $ds) {
                if ($ds['status'] == '1' || ($ds['status'] == '3' && $ds['date_update_cancel'] == null) || $ds['status'] == '7' || $ds['status'] == '5') {
                    $count_ongoing += 1;
                } else if ($ds['status'] == '2' || ($ds['status'] == '3' && $ds['date_update_cancel'] != null)) {
                    $count_done += 1;
                } else if ($ds['status'] == '3' && $ds['date_update_cancel'] == null) {
                    $count_cancel += 1;
                }
            }

            $row[] = $item->no_transaksi_package;
            $row[] = $item->name_teacher;

            $startdate = date_create(substr($item->created_at, 0, 10));
            $tgl_awal = date_format($startdate, "d/m/Y");

            $enddate = date_create(substr($item->end_at, 0, 10));
            $tgl_akhir = date_format($enddate, "d/m/Y");

            $today = date("Y-m-d");

            $row[] = $tgl_awal . " - " . $tgl_akhir;

            $status_pack = "";
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $status_pack = '<span class="badge badge-primary text-white">Choose The Date !</span>';
            } else {
                if (count($data_schedule) == $count_done) {
                    $status_pack = '<span class="badge badge-danger">Done</span>';
                } else if (($count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">2 pack more!</span>';
                } else if (($count_ongoing == 2 || $count_ongoing == 1) && $count_done > 0) {
                    $status_pack = '<span class="badge badge-warning text-white">1 pack more!</span>';
                } else {
                    $status_pack = '<span class="badge text-white" style="background-color:#00B050">On Going</span>';
                }
            }
            $row[] = $status_pack;
            // $row[] = $status_pack ." - ". $count_ongoing ." - " . $count_done ." - " . $count_cancel;
            // add html for action
            if ($count_ongoing == 0 && $count_done == 0 && $count_cancel == 0) {
                $row[] = '';
            } else {
                if (count($data_schedule) == $count_done) {
                    $row[] = '<a class="text-danger" href="' . site_url('portal/online-pratical/calendar/' . $item->id_list_pack . '/1') . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else if (($count_ongoing == 2 || $count_ongoing == 1 || $count_ongoing == 3 || $count_ongoing == 4) && $count_done > 0) {
                    $row[] = '<a class="text-warning" href="' . site_url('portal/online-pratical/calendar/' . $item->id_list_pack . '/1') . '" style="font-size:23px;"> <i class="fa fa-calendar"></i> </a><br>';
                } else {
                    $row[] = '<a href="' . site_url('portal/online-pratical/calendar/' . $item->id_list_pack . '/1') . '" style="font-size:23px; color:#00B050"> <i class="fa fa-calendar"></i> </a><br>';
                }
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_Parent->count_all($dbTable, $id_student, null, $jenis),
            "recordsFiltered" => $this->M_Parent->count_filtered($dbTable, $id_student, null, $jenis),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function online_theory()
    {
        $this->cekLogin();
        $student = $this->M_Parent->getData_student(null, $this->session->userdata('id'));
        $title = "Offline Lesson | Portal Etude";
        $description = "Welcome to Portal Etude";
        $this->load->view('portal/reuse/header', array('title' => $title, 'description' => $description, 'student' => $student));
        $this->load->view('portal/parent/data_theory');
        $this->load->view('portal/reuse/footer');
    }
}
