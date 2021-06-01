<?php
class Excel_import_model extends CI_Model
{
	function select()
	{
		$this->db->order_by('CustomerID', 'DESC');
		$query = $this->db->get('tbl_customer');
		return $query;
	}

	function insert($items)
	{
		//$this->db->insert_batch('person_survey_test', $data);
		$n = 0;
		$this->db->trans_start();
		foreach ($items as $item) {
			$insert_query = $this->db->insert_string('person_survey', $item);
			$insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
			$rs = $this->db->query($insert_query);
			if ($rs) {
				$n++;
			}
		}
		$this->db->trans_complete();
		return $n;
	}

	public function check_person_cid($cid)
	{
		$rs = $this->db
			->from("person_survey")
			->where('cid', $cid)
			->count_all_results();
		return $rs;
	}
}
