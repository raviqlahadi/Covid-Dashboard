<?php 
class Table_template 
{
    public function action_dropdown($url, $id, $edit_url=null)
    {
        if($edit_url!=null){
            $edit = "<a class='dropdown-item' href='" . $edit_url . "'>Edit</a>";
        }else{
            $edit = " <a class='dropdown-item' href='" . $url . "/edit/" . $id . "'>Edit</a>";
        }
        return "
            <div class='dropdown'>
                <button class='btn btn-primary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Action
                </button>
                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                    ".$edit."
                    <a class='dropdown-item text-danger' href='" . $url . "/delete/" . $id . "'>Delete</a>
            </div>
        ";
    }

    public function set_pagination($pagination)
    {
        
        
        $config['base_url'] = $pagination['base_url'];
        $config['total_rows'] = $pagination['total_records'];
        $config['per_page'] = $pagination['limit_per_page'];
        $config["uri_segment"] = $pagination['uri_segment'];

        // custom paging configuration
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        
        // build paging links
        return $config;
    }
}
    
?>