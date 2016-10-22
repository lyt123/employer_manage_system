<?php

//这个类的一个对象实例，表示一条记录雇员
class Emp{

    private $id;
    private $name;
    private $grade;
    private $email;
    private $salary;
    /**
     * @return unknown
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return unknown
     */
    public function getGrade() {
        return $this->grade;
    }

    /**
     * @return unknown
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return unknown
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return unknown
     */
    public function getSalary() {
        return $this->salary;
    }

    /**
     * @param unknown_type $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @param unknown_type $grade
     */
    public function setGrade($grade) {
        $this->grade = $grade;
    }

    /**
     * @param unknown_type $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param unknown_type $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @param unknown_type $salary
     */
    public function setSalary($salary) {
        $this->salary = $salary;
    }


}
?>