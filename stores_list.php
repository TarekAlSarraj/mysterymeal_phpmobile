<?php




    class Constants
    {
        //DATABASE DETAILS
        static $DB_SERVER="localhost";
        static $DB_NAME="id16644001_mysterymeal_db";
        static $USERNAME="id16644001_mysterymealdb";
        static $PASSWORD="gmd$0RC09+{NCa%U";
        //STATEMENTS
        static $SQL_SELECT_ALL="SELECT * FROM stores";
    
    }
    
    class Stores
    {
        /*******************************************************************************************************************************************/
        /*
           1.CONNECT TO DATABASE.
           2. RETURN CONNECTION OBJECT
        */
        public function connect()
        {
            $con=new mysqli(Constants::$DB_SERVER,Constants::$USERNAME,Constants::$PASSWORD,Constants::$DB_NAME);
            if($con->connect_error)
            {
                // echo "Unable To Connect"; - For debug
                return null;
            }else
            {
                //echo "Connected"; - For debug
                return $con;
            }
        }
        /*******************************************************************************************************************************************/
        /*
           1.SELECT FROM DATABASE.
        */
        public function select()
        {
            $con=$this->connect();
            if($con != null)
            {
                $result=$con->query(Constants::$SQL_SELECT_ALL);
                if($result->num_rows>0)
                {
                    $stores=array();
                    while($row=$result->fetch_array())
                    {
                        array_push($stores, array("id"=>$row['id'],"s_name"=>$row['s_name'],
                        "s_category"=>$row['s_category'],"s_address"=>$row['s_address'],
                        "s_phone"=>$row['s_phone'],"s_close_time"=>$row['s_close_time']));
                    }
                    print(json_encode(array_reverse($stores)));
                }else
                {
                    print(json_encode(array("PHP EXCEPTION : CAN'T RETRIEVE FROM MYSQL. ")));
                }
                $con->close();
    
            }else{
                print(json_encode(array("PHP EXCEPTION : CAN'T CONNECT TO MYSQL. NULL CONNECTION.")));
            }
        }
    }
    $stores=new Stores();
    $stores->select();
    
    //end


    ?>