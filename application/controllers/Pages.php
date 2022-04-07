<?php
class Pages extends CI_Controller {

        public function view($page = 'home')
        {     

            if($this->session->logged_in){
                if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
                {
                    // Whoops, we don't have a page for that!
                    show_404();
                } else {
                   
                    $this->load->helper('menu');

                    $data['title'] = ucfirst($page); // Capitalize the first letter
                    $data['menu'] = getMenu($this->session->role);
                    
                    $this->load->view('templates/header', $data);
                    $this->load->view('pages/'.$page, $data);
                    $this->load->view('templates/footer', $data);
                }
                
            }else{
                redirect('/');
            }
            
        }
}