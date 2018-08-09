<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @author
 *
 */

class Order extends MY_Model {

	protected $tablename = 'customer_order_info';
	protected $_table_name = "customer_order_info";

    public function addCustomerOrderInfo($data)
    {
    	$this->db->insert('customer_order_info', $data); 
		return $this->db->insert_id();
    }

    public function addCustomerOrders($data)
    {
        $this->db->insert('customer_orders', $data); 
        return TRUE;
    }

    public function getTableOrder($num)
    {
    	$query = $this->db->query('SELECT * FROM customer_order_info WHERE id = '.$num." AND status = 'current' ");

    	foreach($query->result() as $row)
        {
            $date=date_create($row->order_date);
            $query1 = $this->db->query('SELECT * FROM customer_order_info INNER JOIN customer_orders ON customer_orders.order_id = customer_order_info.id WHERE customer_order_info.id = '.$num.' AND customer_order_info.status = "current" AND '.date_format($date,"Y-m-d").' = '.date('Y-m-d') );
            
            return $query1->result() ;

        }
        
    }

    public function getTableOrdersPaid($num)
    {
        $query = $this->db->query('SELECT * FROM customer_order_info WHERE table_no = '.$num." AND status = 'current' ");

        foreach($query->result() as $row)
        {
            $date=date_create($row->order_date);
            $query1 = $this->db->query('SELECT * FROM customer_order_info INNER JOIN customer_orders ON customer_orders.order_id = customer_order_info.id WHERE customer_order_info.table_no = '.$num.' AND bill_status = 1 AND  customer_order_info.status = "current" AND '.date_format($date,"Y-m-d").' = '.date('Y-m-d') );
            
            return $query1->result() ;

        }
        
    }

    public function getCookingStatus($table_no)
    {
        $query = $this->db->query('SELECT * FROM customer_order_info WHERE table_no = '.$table_no);

        foreach($query->result() as $row)
        {
            $date=date_create($row->order_date);
            $query1 = $this->db->query('SELECT cooking_status FROM customer_order_info WHERE table_no ='.$table_no.' AND status = "current" AND '.date_format($date,"Y-m-d").' = '.date('Y-m-d') );
        }
        //.' AND status = "current" AND '.date_format($date,"Y-m-d").' = '.date('Y-m-d') 
        
        // echo json_encode(@$query1->result());
        $res = @$query1->result();
        if(count($res) > 0)
        {
            $stat = $res[0]->cooking_status;
        }
        else
        {
            $stat = 'Vacant Table';
        }

        return $stat;
    }

    public function update_status($id)
    {
        $this->db->select('*');
        $this->db->from('customer_order_info');
        $this->db->where('cooking_status','On Serve');
        $this->db->where('bill_status','1');
        $this->db->where('id',$id);

        $query = $this->db->get()->result();

        return $query;

    }

}