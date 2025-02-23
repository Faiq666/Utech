<?php
 class  Panel_admin_page_partners extends CI_Controller{
     public function __construct()

     {
         parent::__construct();
         $this->Ana = 'backend';
         $this->Bala = 'partners';
         $this->load->model("Partners_model");

     }

     public function index()

     {
         $data['partners'] = $this->Partners_model->GetPartners();

         $this->load->view("$this->Ana/$this->Bala/partners_list",$data);
     }

     public function partners_add()
     {
         $this->load->view("$this->Ana/$this->Bala/partners_add");
     }

     public function partners_add_act()
     {
       $link = $this->input->post("link");

         $config['upload_path'] = 'uploads/partners';
         $config['allowed_types'] = 'jpg|jpeg|png|gif';
         $config['file_name'] = $_FILES['img']['name'];

         $this->load->library('upload', $config);
         $this->upload->initialize($config);

         if ($this->upload->do_upload('img')) {
             $uploadData = $this->upload->data();
             $image = $uploadData['file_name'];

             if (!empty($link)) {

                 $data = array(
                     'link' => $link,
                     'img'  => $image
                 );
                 $this->Partners_model->AddPartner($data);
                 redirect(base_url("utech_admin_panel_partners"));
             } else {
                 echo "link yuklenmedi";
             }
         }else{
echo "sekil yuklenmedi";
         }

     }



     public function partners_update($id)
     {
       $data['partner'] = $this->Partners_model->Partners_update($id);
         $this->load->view("$this->Ana/$this->Bala/partners_update",$data);

     }

     public function partners_update_act($id)
     {
         $link = $this->input->post("link");

         $config['upload_path'] = 'uploads/partners';
         $config['allowed_types'] = 'jpg|jpeg|png|gif';
         $config['file_name'] = $_FILES['img']['name'];

         $this->load->library('upload', $config);
         $this->upload->initialize($config);

         if ($this->upload->do_upload('img')) {
             $uploadData = $this->upload->data();
             $image = $uploadData['file_name'];

             if (!empty($link)) {

                 $data = array(
                     'link' => $link,
                     'img'  => $image
                 );
                 $this->Partners_model->UpdatePartner($data,$id);
                 redirect(base_url("utech_admin_panel_partners"));
             } else {
                 echo "link yuklenmedi";
             }
         }else{
             echo "sekil yuklenmedi";
         }
     }

     public function partners_delete($id)
     {
         $this->Partners_model->Partners_delete($id);
         redirect(base_url('utech_admin_panel_partners'));
     }


 }