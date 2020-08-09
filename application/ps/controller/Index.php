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

    //查询
    public function search()
    {
        $arrParam = $this->request->get();
        if (isset($arrParam['type']) && is_string($arrParam['type'])) {
            $arrParam['type'] = explode(',', $arrParam['type']);
        }
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

    //导出pdf
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

    //材料数据
    public function material()
    {
        $arrParam = $this->request->get();
        $arrData = [];
        if (isset($arrParam['type']) && $arrParam['type']) {
            $arrType = explode(',', $arrParam['type']);
            if (in_array(4, $arrType)) {
                $arrRe = $this->_pipe_material();
                $arrData = array_merge($arrData, array_column($arrRe, 'material'));
            }
            if (in_array(6, $arrType)) {
                $arrRe = $this->_well_material();
                $arrData = array_merge($arrData, array_column($arrRe, 'material'));
            }
        }
        return jsonSuc($arrData);
    }

    //管径数据
    public function pipeds()
    {
        $arrParam = $this->request->get();
        $arrData = [];
        if (isset($arrParam['type']) && $arrParam['type']) {
            $arrType = explode(',', $arrParam['type']);
            if (in_array(4, $arrType)) {
                $arrRe = $this->_pipe_ds();
                $arrRe = array_column($arrRe, 'd_s');
                sort($arrRe);
                $arrData = array_merge($arrData, $arrRe);
            }
        }
        return jsonSuc($arrData);
    }

    //等级数据
    public function grade()
    {
        $arrParam = $this->request->get();
        $arrData = [];
        if (isset($arrParam['type']) && $arrParam['type']) {
            $arrType = explode(',', $arrParam['type']);
            if (in_array(1, $arrType)) {
                $arrRe = $this->_canal_grade();
                $arrData = array_merge($arrData, array_column($arrRe, 'grade'));
            }
            if (in_array(4, $arrType)) {
                $arrRe = $this->_pipe_grade();
                $arrData = array_merge($arrData, array_column($arrRe, 'grade'));
            }
        }
        return jsonSuc(array_values(array_unique($arrData)));
    }

    //类别数据
    public function sort()
    {
        $arrParam = $this->request->get();
        $arrData = [];
        if (isset($arrParam['type']) && $arrParam['type']) {
            $arrType = explode(',', $arrParam['type']);
            if (in_array(1, $arrType)) {
                $arrRe = $this->_canal_sort();
                $arrData = array_merge($arrData, array_column($arrRe, 'sort'));
            }
            if (in_array(3, $arrType)) {
                $arrRe = $this->_dir_point_sort();
                $arrData = array_merge($arrData, array_column($arrRe, 'sort'));
            }
            if (in_array(4, $arrType)) {
                $arrRe = $this->_pipe_sort();
                $arrData = array_merge($arrData, array_column($arrRe, 'sort'));
            }
            if (in_array(5, $arrType)) {
                $arrRe = $this->_spout_sort();
                $arrData = array_merge($arrData, array_column($arrRe, 'sort'));
            }
            if (in_array(6, $arrType)) {
                $arrRe = $this->_well_sort();
                $arrData = array_merge($arrData, array_column($arrRe, 'sort'));
            }
        }
        return jsonSuc(array_values(array_unique($arrData)));
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

    protected function _pipe_material()
    {
        $Mdl = new \app\ps\model\Pipe();
        $data = $Mdl->distinct(true)->field('material')->select();
        return $data->toArray();
    }

    protected function _well_material()
    {
        $Mdl = new \app\ps\model\Well();
        $data = $Mdl->distinct(true)->field('material')->select();
        return $data->toArray();
    }

    protected function _pipe_ds()
    {
        $Mdl = new \app\ps\model\Pipe();
        $data = $Mdl->distinct(true)->field('d_s')->select();
        return $data->toArray();
    }

    protected function _canal_grade()
    {
        $Mdl = new \app\ps\model\Canal();
        $data = $Mdl->distinct(true)->field('grade')->select();
        return $data->toArray();
    }

    protected function _pipe_grade()
    {
        $Mdl = new \app\ps\model\Pipe();
        $data = $Mdl->distinct(true)->field('grade')->select();
        return $data->toArray();
    }

    protected function _canal_sort()
    {
        $Mdl = new \app\ps\model\Canal();
        $data = $Mdl->distinct(true)->field('sort')->select();
        return $data->toArray();
    }

    protected function _dir_point_sort()
    {
        $Mdl = new \app\ps\model\Dirpoint();
        $data = $Mdl->distinct(true)->field('sort')->select();
        return $data->toArray();
    }

    protected function _pipe_sort()
    {
        $Mdl = new \app\ps\model\Pipe();
        $data = $Mdl->distinct(true)->field('sort')->select();
        return $data->toArray();
    }

    protected function _spout_sort()
    {
        $Mdl = new \app\ps\model\Spout();
        $data = $Mdl->distinct(true)->field('sort')->select();
        return $data->toArray();
    }

    protected function _well_sort()
    {
        $Mdl = new \app\ps\model\Well();
        $data = $Mdl->distinct(true)->field('sort')->select();
        return $data->toArray();
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
