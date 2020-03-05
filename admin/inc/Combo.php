 <?php
 include "../inc/Connect.php";


                  class Combo extends Connect {


                    protected static $cnx;
                    private static function getConnection(){
                    self::$cnx = Connect::conn();

                 }

                 function combo($sql, $name, $id, $value, $label){

                  $query = $sql;

                  self::getConnection();

                  $result = self::$cnx->prepare($query);

                  $result->execute();

                  $rows = $result->rowCount();

                  echo '<div class="form-group">';
                  echo '<label for="' . $id . '">' . $label .'</label>';                    
                  echo '<select name="' . $name . '" id="' . $id. '" class="form-control">';

                  $iniselect = 1;

                  if($rows > 0){

                  if ($iniselect==1){

                  if($value != ""){

                        $divide_values = explode("-",$value);
                        $id = $divide_values[0];
                        $desc = $divide_values[1];

                        echo "<option value='" . $id . "'>". $desc . "</option>";
                          }
                              else{

                                echo "<option value='0'>[ Seleccione una opcion ]</option>";
                              }
                              
                              while(list($id, $descrip) = $result->fetch()){
                               if ($id == $value)
                                   echo '<option selected value="' . $id . '">' . $descrip. '</option>';
                               else
                                   echo '<option value="' . $id . '">' . $descrip. '</option>';
                            }

                          }

                  }else{
                    echo "<option value='0'>'No hay opciones !!'</option>";
                  }

                  echo '</select>';

                  echo '</div>';

                  
                  self::disconnect();

                }

              }



                   ?>