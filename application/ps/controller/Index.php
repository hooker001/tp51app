<?php

namespace app\ps\controller;

use TCPDF;
use think\Controller;

class Index extends Controller
{
    public function home()
    {
        echo 'home';
    }

    public function info()
    {
        return jsonErr('route not found');
    }

    public function search()
    {
        $arrParam = $this->request->get();
        $canalMdl = new \app\ps\model\Canal();
        $arrCanal = $canalMdl->getAll($arrParam);
        $combMdl = new \app\ps\model\Comb();
        $arrComb = $combMdl->getAll($arrParam);
        $dirpointMdl = new \app\ps\model\Dirpoint();
        $arrDp = $dirpointMdl->getAll($arrParam);
        $pipeMdl = new \app\ps\model\Pipe();
        $arrPipe = $pipeMdl->getAll($arrParam);
        $spoutMdl = new \app\ps\model\Spout();
        $arrSpout = $spoutMdl->getAll($arrParam);
        $wellMdl = new \app\ps\model\Well();
        $arrWell = $wellMdl->getAll($arrParam);
        $arrData = [
            'canal' => $arrCanal,
            'comb' => $arrComb,
            'dir_point' => $arrDp,
            'pipe' => $arrPipe,
            'spout' => $arrSpout,
            'well' => $arrWell,
        ];
        return jsonSuc($arrData);
    }

    public function pdf()
    {
        $arrParam = $this->request->get();
        if (!isset($arrParam['gid']) || !isset($arrParam['type'])) {
            return jsonErr('参数缺失');
        }
        $strHtml = '';
        switch (intval($arrParam['type'])) {
            case 1:
                $strHtml = $this->_canal($arrParam['gid']);
                break;
            case 2:
                $strHtml = $this->_comb($arrParam['gid']);
                break;
            case 3:
                $strHtml = $this->_dir_point($arrParam['gid']);
                break;
            case 4:
                $strHtml = $this->_pipe($arrParam['gid']);
                break;
            case 5:
                $strHtml = $this->_spout($arrParam['gid']);
                break;
            case 6:
                $strHtml = $this->_well($arrParam['gid']);
                break;
        }
        if (!$strHtml) {
            return jsonErr('数据不存在');
        }
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);
        $pdf->SetFont('stsongstdlight');
        $pdf->AddPage();
        $pdf->writeHTML($strHtml, true, false, true, false, '');
        $pdf->lastPage();
        $pdf->Output(time() . '.pdf', 'D');

    }

    protected function _canal($gid)
    {
        $info = \app\ps\model\Canal::get($gid);
        if (!$info) {
            return false;
        }
        $strHtml = $this->_tpl($info->toArray());
        return $strHtml;
    }

    protected function _comb($gid)
    {
        $info = \app\ps\model\Comb::get($gid);
        if (!$info) {
            return false;
        }
        $strHtml = $this->_tpl($info->toArray());
        return $strHtml;
    }

    protected function _dir_point($gid)
    {
        $info = \app\ps\model\Dirpoint::get($gid);
        if (!$info) {
            return false;
        }
        $strHtml = $this->_tpl($info->toArray());
        return $strHtml;
    }

    protected function _pipe($gid)
    {
        $info = \app\ps\model\Pipe::get($gid);
        if (!$info) {
            return false;
        }
        $strHtml = $this->_tpl($info->toArray());
        return $strHtml;
    }

    protected function _spout($gid)
    {
        $info = \app\ps\model\Spout::get($gid);
        if (!$info) {
            return false;
        }
        $strHtml = $this->_tpl($info->toArray());
        return $strHtml;
    }

    protected function _well($gid)
    {
        $info = \app\ps\model\Well::get($gid);
        if (!$info) {
            return false;
        }
        $strHtml = $this->_tpl($info->toArray());
        return $strHtml;
    }

    protected function _tpl($arrData)
    {
        $strTpl = <<<TPL
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <style type="text/css">
            .content{width: 80%;position: absolute;left: 10%;text-align: center;}
            .content table{width: 100%;border: 1px grey solid;}
            .content table td{border-bottom: 1px black solid;border-right: 1px black solid;height: 40px;line-height: 40px;}
        </style>
        <div class="content">
            <h1>PDF示例</h1>
            <table>
                <tr><td bgcolor="#F5F5DC">编号</td><td colspan="3">{$arrData['fcode']}</td></tr>
                <tr><td colspan="4" bgcolor="#CCCCCC">{$arrData['name']}:信息</td></tr>
                <tr><td bgcolor="#F5F5DC">名称</td><td>{$arrData['name']}</td><td bgcolor="#F5F5DC">编号</td><td>{$arrData['usid']}</td></tr>
            </table>
        </div>
    </body>
    </html>
TPL;
        return $strTpl;
    }
}
