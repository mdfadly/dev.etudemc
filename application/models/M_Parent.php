<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Parent extends CI_Model
{

    var $column_order_list_package_offline = array('t.name_teacher', null,  null);
    var $column_search_list_package_offline = array('t.name_teacher');
    var $order_list_package_offline = array('lp.id_list_package_offline' => 'asc');

    private function _get_datatables_query_list_package_offline($id_student)
    {
        $this->db->select('lp.*, s.name_student, t.name_teacher');
        $this->db->from('list_package_offline as lp');
        $this->db->where('lp.id_student', $id_student);
        $this->db->join('student as s', 'lp.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'lp.id_teacher = t.id_teacher', 'left');
        $this->db->where('lp.status', '1');
        $this->db->order_by('lp.created_at', 'DESC');

        $i = 0;
        foreach ($this->column_search_list_package_offline as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_list_package_offline) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_list_package_offline[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_list_package_offline = $this->order;
            $this->db->order_by(key($order_list_package_offline), $order_list_package_offline[key($order_list_package_offline)]);
        }
    }

    var $column_order_online_pratical = array('t.name_teacher', null,  null);
    var $column_search_online_pratical = array('t.name_teacher');
    var $order_online_pratical = array('lp.id_list_pack' => 'asc');

    private function _get_datatables_query_online_pratical($id_student, $jenis)
    {
        $this->db->select('lp.*, s.name_student, t.name_teacher');
        $this->db->from('list_package as lp');
        $this->db->where('lp.id_student', $id_student);
        $this->db->join('student as s', 'lp.id_student = s.id_student', 'left');
        if ($jenis === '1') {
            $this->db->join('teacher as t', 'lp.id_teacher_practical = t.id_teacher', 'left');
        } else {
            $this->db->join('teacher as t', 'lp.id_teacher_theory = t.id_teacher', 'left');
        }
        $this->db->where('lp.status', '1');
        $this->db->order_by('lp.created_at', 'DESC');

        $i = 0;
        foreach ($this->column_search_online_pratical as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_online_pratical) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_online_pratical[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_online_pratical = $this->order;
            $this->db->order_by(key($order_online_pratical), $order_online_pratical[key($order_online_pratical)]);
        }
    }

    function get_datatables($table, $id_student = null, $id_parent = null, $jenis = null)
    {
        if ($table == "list_package_offline") {
            $this->_get_datatables_query_list_package_offline($id_student);
        }
        if ($table == "list_package") {
            $this->_get_datatables_query_online_pratical($id_student, $jenis);
        }

        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($table, $id_student = null, $id_parent = null, $jenis = null)
    {
        if ($table == "list_package_offline") {
            $this->_get_datatables_query_list_package_offline($id_student);
        }
        if ($table == "list_package") {
            $this->_get_datatables_query_online_pratical($id_student, $jenis);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all($table, $id_student = null, $id_parent = null, $jenis = null)
    {
        $this->db->from($table);
        if ($table == "list_package_offline") {
            $this->db->where('status', '1');
            $this->db->where('id_student', $id_student);
        }
        if ($table == "list_package") {
            $this->db->where('id_student', $id_student);
            $this->db->where('status', '1');
        }
        return $this->db->count_all_results();
    }

    public function getData_student($id_student = null, $id_parent = null)
    {
        $this->db->select('*');
        $this->db->from('student as t');
        $this->db->where('t.status', '1');
        if ($id_student != null) {
            $this->db->where('id_student', $id_student);
        }
        if ($id_parent != null) {
            $this->db->where('id_parent', $id_parent);
        }
        return $this->db->get()->result_array();
    }

    public function getData_schedule_package_offline($id_schedule_package_offline = null, $id_list_package_offline = null, $cek_status = null, $today = null, $jenis = null, $daysago = null)
    {
        $this->db->select('so.*, s.name_student, s.id_student, t.name_teacher, t.id_teacher,');
        $this->db->from('schedule_package_offline as so');
        $this->db->join('student as s', 'so.id_student = s.id_student', 'left');
        $this->db->join('teacher as t', 'so.id_teacher = t.id_teacher', 'left');
        $this->db->join('list_package_offline as op', 'so.id_list_package_offline = op.id_list_package_offline', 'left');
        // $this->db->where('so.status', '1');
        if ($id_schedule_package_offline != null) {
            $this->db->where('so.id_schedule_package_offline', $id_schedule_package_offline);
        }
        if ($id_list_package_offline != null) {
            $this->db->where('so.id_list_package_offline', $id_list_package_offline);
        }
        if ($today != null) {
            $this->db->where('so.date_schedule <', $today);
        }
        if ($daysago != null) {
            $this->db->where('so.date_schedule >', $daysago);
        }
        if ($cek_status != null) {
            $this->db->where('so.status', $cek_status);
        }
        return $this->db->get()->result_array();
    }

    function fetch_all_package_offline($id_list_package_offline, $id_student = NULL)
    {
        $this->db->select('sc.*, s.name_student');
        $this->db->from('schedule_package_offline as sc');
        $this->db->where('sc.id_list_package_offline', $id_list_package_offline);
        if ($id_student != null) {
            $this->db->where('sc.id_student', $id_student);
            $this->db->join('student as s', 'sc.id_student = s.id_student', 'left');
        }
        $this->db->order_by("id_schedule_package_offline", "ASC");
        return $this->db->get();
    }
}
