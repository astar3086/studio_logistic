<div class="panel panel-default">
    <div class="panel-heading">Routers</div>
    <div class="panel-body">
        <?php

        foreach ( $data['routing_data']['controller'] as $controller => $actions ){
            echo '<h1>'.$controller.'</h1><p>';

            foreach ( $actions as $action => $key2 ){
                echo '
                        <div class="radio">
                          <label><input type="radio" name="route"
                          data-controller="'.$controller.'" data-action="'.$action.'">'.$key2.'</label>
                        </div>

                    ';
            }
        }

        ?>

        <!-- Indicates a successful or positive action -->
        <div class="form-group">
            <button type="button" class="btn btn-success send">Send Request</button>
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-default clean">Clean Response</button>
        </div>

    </div>
</div>