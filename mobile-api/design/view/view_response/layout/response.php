<div class="panel panel-default">
    <div class="panel-body">

<?php

$user['fio'] = 'Current User';
if ( !is_array( $data ) ){
    echo '
                    <div class="alert alert-success" role="alert">Value:: '.$data['response'].'</div>
                 ';
} else {
    foreach ( $data['response'] as $key => $value )
    {

        $info = ' &nbsp;&nbsp;
                <span class="label label-primary">Date:: '.date('Y-m-d H:i').'</span>
            ';

        if ( $key == 'status' && (int)$value >= 0 )
        {
            echo '
                    <div class="alert alert-success" role="alert">Success! '.$info.'</div>
                 ';
        }
        else if ( $key == 'status' && $value < 0 )
        {
            echo '
                    <div class="alert alert-danger" role="alert">Error! '.$info.'</div>
                    <div class="alert alert-warning" role="alert">'.$value.'</div>
                 ';
        } else if ( $key != 'error' ) {

            if ( $key !== 'feedback'){
                echo '
                    <p class="bg-info">'.$key.' :: '.$value.$info.'</p>
                 ';

            } else {

                var_dump(get_object_vars($value));

            }
        }

    };
}


?>

    </div>
</div>

