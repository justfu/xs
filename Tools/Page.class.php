<?php
namespace Tools;
class Page{
    private $RowCounts;//分页总记录数
    public $pageCount=10;//每页显示数量
    public $pageCounts;//总页数
    public $nav;//返回导航条信息
    public $res;//返回当前页面的数据
    public $page=1;//当前页面
    private $model;//需要分页的对应的表的对象
    private $modelname;
    private $fields;//当前表需要分页的字段;减少数据库读取压力,避免读取不必要的字段
    private $where;//分页条件
    private $order;

    /*
     * 初始化分页类
     */
    public function __construct($model,$fields=array(),$where,$order=''){
         $this->where=$where;
         $this->modelname=$model;
         $this->model=D($model);
         $this->order=$order;
         foreach($fields as $k => $v){
             $this->fields.=$v.',';
         }
         $this->fields=rtrim($this->fields,',');
    }

    /*
     * 获得需要分页表的总记录数量
     */
    public function getAllCounts(){
         $this->RowCounts=$this->model->field('count(*)')->where("$this->where")->select()[0]['count(*)'];
         return $this->RowCounts;
    }


    /*
     * 计算总分页数
     */

    public function getPageCounts(){
        $this->getAllCounts();
        $this->pageCounts=ceil($this->RowCounts/$this->pageCount);
        return $this->pageCounts;
    }
    /*
     * 返回数据
     */
    public function returnPageData($nowpage){
        $this->getAllCounts();
        $limit=$this->pageCount*($nowpage-1).','.$this->pageCount;
        return $this->model->field($this->fields)->limit($limit)->where("$this->where")->order("$this->order")->select();
    }
}