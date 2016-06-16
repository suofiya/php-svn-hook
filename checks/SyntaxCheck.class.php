<?php
/**
 * @file SyntaxCheck.class.php
 *
 * @author tyliu1123@163.com
 * @version
 * @desc 提交时校验PHP语法
 * @modify 2016-06-15
 */
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'BasePreCommitCheck.class.php';

class SyntaxCheck extends BasePreCommitCheck {

  function getTitle(){
    return "PHP Script Syntax Check";
  }

  public function renderErrorSummary(){
    //return "Commit File Detect Error!!";
  }

  public function checkFullFile($lines, $filename){

    //exec("svnlook cat $this->repoName $filename -t $this->trxNum | php -l ", $result); 
    //repoName和trxNum为Manager工厂类属性，不属于具体每个Check类，因为不能使用svnlook直接获取修改文件内容；
    // lines为文件行内容array 
    exec('echo "'.implode(PHP_EOL, $lines).'"| /usr/bin/php -l', $result);

    if ( count($result) <> 1 ){
      $rs = $result[1] . " ($filename)";
      return $rs;
    }

  }

  public function renderInstructions(){
    return "";
  }

}
