
    <div class="nav-wrap">
        <div style="padding-top:10px; text-align:center">
        <ul class="nav-left">
          <?php
            $user_id = Session::get('user_id');
            $user_role = \App\User::where('id','=',$user_id)->first()->user_role;
            $role = array();
            if($user_role != 'super_admin')
            {
              $user_role = explode(',',$user_role);
              for($i=0;$i<sizeof($user_role);$i++)
              {
                  echo '
                <li class="desktop-toggle">
                    <a href="'.$user_role[$i].'">
                      '.ucfirst($user_role[$i]).'
                    </a>
                </li>


                  ';
              }
            }
            else
            {

               echo'
               <li class="desktop-toggle">
                <a href="super_admin">
                 Super Admin
                </a>
                 </li>
               <li class="desktop-toggle">
                    <a href="admin">
                      Admin
                    </a>
                     </li>
                <li class="desktop-toggle">
                    <a href="intaker">
                      Inaker
                    </a>
                     </li>
                 <li class="desktop-toggle">
                    <a href="scheduler">
                      Scheduler
                    </a>
                 </li>';

            }
            ?>


        </ul>
        </div>

    </div>





