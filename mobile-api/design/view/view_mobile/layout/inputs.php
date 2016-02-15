<div class="panel-body inputs">
    <form role="form" id="api_form" action="">
        <?php

        foreach ( $data['testing_data'] as $key => $value ){
            echo '
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">'.$key.'</span>
                  <input type="text" value="'.$value.'" name="'.$key.'" class="form-control" placeholder="'.$key.'" aria-describedby="basic-addon1">
                </div>
                ';
        }

        ?>
    </form>
</div>
