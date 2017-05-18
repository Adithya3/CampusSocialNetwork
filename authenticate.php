
<?php
    session_start();
    function authenticate($user, $password,$role,$conn,$dept)
    {
    if(empty($user) || empty($password)) {
        return false;
    }

    /* local authentication */
    if ($role=='Admin'){
        if ($user=='admin' & $password=='admin'){
            $_SESSION['valid']=true;
            $_SESSION['user'] = $user;
            $_SESSION['role']=$role;
            $_SESSION['conn']=$conn;
            $_SESSION['timeout'] = time();
            return true;
        }
    }
    elseif ($role=='Moderator'){
        $table_name=str_replace(' ', '', $dept)."StudentTeacher";
        $result = mysqli_query($conn, "SELECT * FROM Moderator WHERE Username='".$user."'");
        if ($result->num_rows){
            $row = mysqli_fetch_array($result);
            if ($row['Password']==$password and $row['Department']==$dept){
                $_SESSION['valid']=true;
                $_SESSION['user'] = $user;
                $_SESSION['role']=$role;
                $_SESSION['department']=$dept;
                $_SESSION['conn']=$conn;
                $_SESSION['table_name']= $table_name;
                $_SESSION['id'] =  mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM Chat WHERE UserId='".$user."'"))[0];
                $_SESSION['timeout'] = time();
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    elseif ($role=='Student' or $role=='Teacher'){
        $table_name=str_replace(' ', '', $dept)."StudentTeacher";
        $result = mysqli_query($conn, "SELECT * FROM ".$table_name." WHERE Username='".$user."' AND Password='".$password."'");
        if ($result->num_rows){
            $row = mysqli_fetch_array($result);
            if ($row['Password']==$password){
                $_SESSION['valid']=true;
                $_SESSION['user'] = $user;
                $_SESSION['role']=$role;
                $_SESSION['department']=$dept;
                $_SESSION['conn']=$conn;
                $_SESSION['table_name']= $table_name;
                $_SESSION['timeout'] = time();
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    else {
        return false;
    }
}
?>