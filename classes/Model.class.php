<?php


class Model extends Dbh
{
    protected function validLogin($username,$password)
    {
        $sql = "SELECT * FROM user_accounts WHERE username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $rowCount = $stmt->rowCount();

        $results = $stmt->fetch();

        if($rowCount == 0){
            return false;
        } else {
            if(!password_verify($password,$results['password'])){
                return false;
            } else {
                return true;
            }
        }
    }

    protected function insertLoginAction($device,$ipAddress,$location)
    {
        $sql = "INSERT INTO user_action (`device`,`ip_address`,`location`) VALUES (?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$device,$ipAddress,$location]);
        return;
    }

    protected function getPrivilege($email)
    {
        $sql = "SELECT privilege FROM user_accounts WHERE username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        return $result;
    }

    protected function getDatas()
    {
        $sql = "SELECT *,lh.id FROM borrower_personal_information pi JOIN borrower_loan_history lh ON pi.id = lh.id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function checkPastDue()
    {
        $today = date("Y-m-d");
        $sql = "UPDATE borrower_loan_history SET `status` = 'Past due' WHERE `borrow_date` < ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$today]);
    }

    private function borrowWithInterest()
    {
        $sql = "SELECT borrow_amount,interest_rate FROM borrower_loan_history WHERE status = 'Active' OR status = 'Past due'";
    }

    protected function getLoginUserData($userEmail)
    {
        $sql = "SELECT firstname,middlename,lastname FROM user_details WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userEmail]);

        $result = $stmt->fetch();

        return $result;
    }

    protected function getSingleDetails($id)
    {
        $sql = "SELECT * FROM borrower_personal_information pi
        JOIN borrower_job_information ji
            ON pi.id = ji.id
        JOIN borrower_references_information ri
            ON pi.id = ri.id
        JOIN borrower_loan_history lh
            ON ji.id = lh.id
        WHERE pi.id = ?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();

        return $result;
    }

    protected function getSingleRepayment($id)
    {
        $sql = "SELECT repayment_type,repayment_every,repayment_count,repayment_days_count,interest_rate FROM repayment_type WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        
        if(!$stmt->execute([$id])){
            exit(json_encode(false));
        } else {
            $rowCount = $stmt->rowCount();

            if($rowCount <= 0) {
                exit(json_encode(false));
            } else {
                $results = $stmt->fetch();
                exit(json_encode($results));
            }   
        }
    }

    protected function deleteSingleRepayment($id)
    {
        $sql = "DELETE FROM repayment_type WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        
        if(!$stmt->execute([$id])){
            exit(json_encode(false));
        } else {
            $rowCount = $stmt->rowCount();

            if($rowCount <= 0) {
                exit(json_encode(false));
            } else {
                exit(json_encode('deleted'));
            }   
        }
    }

    protected function getRepayment()
    {
        $sql = "SELECT * FROM repayment_type ORDER BY repayment_type";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;
    }

    protected function repaymentValidatePassword($email,$password)
    {
        if(!$this->validLogin($email,$password)) {
            exit(json_encode(false));
        } else {
            exit(json_encode(true));
        }
    }

    protected function addEditRepayment($repaymentName,$interestRate,$repaymentEvery,$repaymentCount,$repaymentDaysCount,$email,$repaymentAction,$id)
    {
        if($repaymentAction == 'add'){
            $this->checkExistingRepayment($repaymentName);

            $sql = "INSERT INTO repayment_type (`repayment_type`,`interest_rate`,`repayment_every`,`repayment_count`,`added_by`) VALUES (?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
    
            if(!$stmt->execute([$repaymentName,$interestRate,$repaymentEvery,$repaymentCount,$email])) {
                exit(json_encode(false));
            } else {
                exit(json_encode(true));
            }
        } elseif($repaymentAction == 'edit'){
            $sql = "UPDATE repayment_type SET `repayment_type` = ?, `interest_rate` = ?, `repayment_every` = ?, `repayment_count` = ?, `repayment_days_count` = ?, `added_by` = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            
            if(!$stmt->execute([$repaymentName,$interestRate,$repaymentEvery,$repaymentCount,$repaymentDaysCount,$email,$id])) {
                exit(json_encode(false));
            } else {
                exit(json_encode(true));
            }
        } else {
            return;
        }        
    }

    protected function checkExistingRepayment($repaymentName)
    {
        $sql = "SELECT repayment_type FROM repayment_type WHERE repayment_type = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute([$repaymentName])) {
            exit(json_encode(false));
        } else {
            $rowCount = $stmt->rowCount();
            if($rowCount > 0){
                exit(json_encode('you'));
            } else {
                return;
            }
        }
    }

    protected function repaymentDetails($repaymentName)
    {
        $sql = "SELECT repayment_type,repayment_every,repayment_count,repayment_days_count,interest_rate,added_by FROM repayment_type WHERE repayment_type = ?";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute([$repaymentName])) {
            exit(0);
        } else {
            $results = $stmt->fetch();
            return $results;
        }
    }

    protected function addRepaymentDetails($id,$transId,$paymentDate,$amount,$email,$remarks)
    {
        $sql = "INSERT INTO borrower_payment_history (`borrower_id`,`transaction_id`,`payment_date`,`amount`,`added_by`,`remarks`) VALUES (?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        

        if(!$stmt->execute([$id,$transId,$paymentDate,$amount,$email,$remarks])) {
            exit(0);
        } else {
            echo "<script>alert('Payment successfully added')</script>";
            echo "<script>location.href = '../' </script>";
        }
    }

} // end of class