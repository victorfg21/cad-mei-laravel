<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Util\Metodos;

use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\Atendimento;
use App\AtendimentoServicos;
use App\Empresa;
use App\Servico;

class RelatorioController extends Controller
{
  //Disponível em https://codepen.io/hairylemon/pen/MzXXeM - Artista Hairylemon 
    const html_servico = '
  <html>
  <head>
    <style>
      body {
        font-family: sans-serif;
        font-size: 10pt;
      }
  
      p {
        margin: 0pt;
      }
  
      table {
        vertical-align: top;
        font-size: 9pt;
        border-collapse: collapse;
        font-family: sans-serif;
      }
  
      tr {
        padding: 1cm 0;
      }
  
      td {
        vertical-align: middle;
      }
  
      .header td {
        vertical-align: bottom;
      }
  
      table.items thead td {
        font-weight: bold;
        border-top: 0.1mm solid #AAA;
        border-bottom: 0.1mm solid #AAA;
      }
  
      table.items tr {
        border-bottom: 0.1mm solid #EEE;
      }
    </style>
  </head>
  
  <body>
    
      <htmlpagefooter name="myfooter">
      <div style="padding-bottom: 3mm; color: #25266C; text-align: center;">
      <div style="font-weight: bold; font-size: 16pt;">
      <!--It s the security of knowing we re there.-->
      </div>
      <div style="font-size: 8pt;">
      <!--Union Medical Benefits Society Ltd, 165 Gloucester Street, PO Box 1721, Christchurch 8140.-->
      </div>
      <div style="font-size: 8pt;">
      <!--Phone 64-3-365 4048, Fax 64-3-365 4066, Freephone 0800 600 666. <a href="www.unimed.co.nz">www.unimed.co.nz</a>-->
      </div>
      </div>
      <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm;">
      Página {PAGENO} de {nb}
      </div>
      </htmlpagefooter>
      <sethtmlpagefooter name="myfooter" value="on" />

    <table class="header" width="100%" cellpadding="10">
      <tr>        
        <td width="70%" style="font-weight: bold; font-size: 16pt;">CadMEI - Relatório</td>
        <!--LOGO
        <td width="30%"><img src="https://www.unimed.co.nz/wp-content/uploads/2017/02/logo.png" /></td>
        -->
      </tr>
    </table>
    <table width="100%" cellpadding="5" style="margin: 1cm 0 0.3cm 0; background-color: #7698CC; color: #FFF;">
      <tr>
        <td style="font-size: 12pt">#####TITULO#####</td>
      </tr>
    </table>
    <table width="100%" cellpadding="5">        
      #####CONTEUDO#####
    </table>
    <table width="100%" cellpadding="5">
      <tr>
        <td>
          <hr/>#####RODAPE#####</td>
        <td>
          <hr/><strong>#####TOTAL#####</strong></td>
      </tr>
    </table> 
    <br>     
    <br>     
    <table width="100%" cellpadding="5">
      <tr>
        <td><strong>Período: </strong> #####INI#####     -     #####FIM#####</td>
      </tr>
    </table>
  </body>
  
  </html>';

    //construtor
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $servico_list = Servico::orderBy('descricao')->get();
        return view('admin.relatorios.index', compact('servico_list'));
    }

    public function servicos(Request $request)
    {
        $request->validate([
          'servico_ret' => 'required',
          'inicioServico' => 'required|date_format:Y-m-d|before:fimServico',
          'fimServico' => 'required|date_format:Y-m-d|after:inicioServico',          
        ], $mensagensErro = [
            'required' => 'Campo obrigatório',
            'max' => 'Quantidade caracteres excedido',
            'date' => 'Data inválida',
            'before' => 'Data inicial deve ser anterior a data final',
            'after' => 'Data final deve ser posterior a data inicial',
            'unique' => 'O :attribute já está cadastrado! Não é permitido registro duplicado',
        ]);

        $dados = $request->all();
        $id_servico = $dados['servico_ret'];
        $ini = date("d/m/Y", strtotime($dados['inicioServico']));
        $fim = date("d/m/Y", strtotime($dados['fimServico']));

        $servico = '';
        $conteudo = '';
        $html_linha_header_todos = '
        <tr>
          <td width="20%"><strong>CNPJ</strong></td>
          <td width="20%"><strong>Descrição</strong></td>
        </tr>
        #####LINHAS#####';
        $html_linha_header_declaracao = '
        <tr>
          <td width="20%"><strong>CNPJ</strong></td>
          <td width="20%"><strong>Ano</strong></td>
          <td width="20%"><strong>Valor</strong></td>
        </tr>
        #####LINHAS#####';
        $html_linha_tabela_todos = '
        <tr>
          <td>#####CNPJ#####</td>
          <td>#####DESCRICAO#####</td>
        </tr>';
        $html_linha_tabela_declaracao = '
        <tr>
          <td>#####CNPJ#####</td>
          <td>#####ANO#####</td>
          <td>#####VALOR#####</td>
        </tr>';
        $tabela = '';
        $rodape_label = '';
        $tot = 0;
        if ($id_servico == '4') {
            $registros = DB::table('atendimentos')
                          ->leftJoin('empresas', 'atendimentos.empresa_id', '=', 'empresas.id')
                          ->leftJoin('atendimento_servicos', 'atendimentos.id', '=', 'atendimento_servicos.atendimento_id')
                          ->leftJoin('servicos', 'atendimento_servicos.servico_id', '=', 'servicos.id')
                          ->where('atendimento_servicos.servico_id', '=', $id_servico)
                          ->whereRaw('CAST(atendimentos.data AS DATE) BETWEEN ? AND ?', [$ini, $fim])
                          ->select(DB::raw('cnpj, ano_declaracao, to_char(valor_total, \'L9G999G990D99\') as valor_total, descricao'))
                          ->get();
            
            if (!empty($registros->first())) {
                $servico = $registros->first()->descricao;
                foreach ($registros as $key => $value) {
                    $temp = $html_linha_tabela_declaracao;
                    $temp = str_replace('#####CNPJ#####', $value->cnpj, $temp);
                    $temp = str_replace('#####ANO#####', $value->ano_declaracao, $temp);
                    $temp = str_replace('#####VALOR#####', 'R$ ' . $value->valor_total, $temp);
                    $conteudo .= $temp;
                }

                $registros = DB::table('atendimentos')
                          ->leftJoin('atendimento_servicos', 'atendimentos.id', '=', 'atendimento_servicos.atendimento_id')
                          ->where('atendimento_servicos.servico_id', '=', $id_servico)
                          ->select(DB::raw('to_char(sum(valor_total), \'L9G999G990D99\') as valor_total'))
                          ->get();
                $tot = $registros->first()->valor_total;

                $tabela = str_replace('#####LINHAS#####', $conteudo, $html_linha_header_declaracao);
                $rodape_label = 'VALOR TOTAL';
            }
            else{    
              return response()->view('errors.relatorio_erro');
            }
        } else {
            $registros = DB::table('atendimentos')
                          ->leftJoin('empresas', 'atendimentos.empresa_id', '=', 'empresas.id')
                          ->leftJoin('atendimento_servicos', 'atendimentos.id', '=', 'atendimento_servicos.atendimento_id')
                          ->leftJoin('servicos', 'atendimento_servicos.servico_id', '=', 'servicos.id')
                          ->where('atendimento_servicos.servico_id', '=', $id_servico)
                          ->whereRaw('CAST(atendimentos.data AS DATE) BETWEEN ? AND ?', [$ini, $fim])
                          ->get();

            if (!empty($registros->first())) {
                $servico = $registros->first()->descricao;
                foreach ($registros as $key => $value) {
                    $temp = $html_linha_tabela_todos;
                    $temp = str_replace('#####CNPJ#####', $value->cnpj, $temp);
                    $temp = str_replace('#####DESCRICAO#####', $value->observacao, $temp);
                    $conteudo .= $temp;
                    $tot++;
                }
            }
            else{    
              return response()->view('errors.relatorio_erro');
            }

            $tabela = str_replace('#####LINHAS#####', $conteudo, $html_linha_header_todos);
            $rodape_label = 'TOTAL';
        }

        $html = str_replace('#####CONTEUDO#####', $tabela, RelatorioController::html_servico);
        $html = str_replace('#####TITULO#####', 'Empresa X Setor', $html);
        $html = str_replace('#####TOTAL#####', $tot, $html);
        $html = str_replace('#####INI#####', $ini, $html);
        $html = str_replace('#####FIM#####', $fim, $html);
        $html = str_replace('#####RODAPE#####', $rodape_label, $html);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function empresas(Request $request)
    {
      $request->validate([
        'inicioEmpresa' => 'required|date_format:Y-m-d|before:fimEmpresa',
        'fimEmpresa' => 'required|date_format:Y-m-d|after:inicioEmpresa',          
      ], $mensagensErro = [
          'required' => 'Campo obrigatório',
          'max' => 'Quantidade caracteres excedido',
          'date' => 'Data inválida',
          'before' => 'Data inicial deve ser anterior a data final',
          'after' => 'Data final deve ser posterior a data inicial',
          'unique' => 'O :attribute já está cadastrado! Não é permitido registro duplicado',
      ]);

      $dados = $request->all();
      $ini = date("d/m/Y", strtotime($dados['inicioEmpresa']));
      $fim = date("d/m/Y", strtotime($dados['fimEmpresa']));

      $conteudo = '';
      $html_linha_header_todos = '
      <tr>
        <td width="20%"><strong>Setor</strong></td>
        <td width="20%"><strong>Quantidade</strong></td>
      </tr>
      #####LINHAS#####';
      $html_linha_tabela_todos = '
      <tr>
        <td>#####SETOR#####</td>
        <td>#####QUANTIDADE#####</td>
      </tr>';
      $tabela = '';
      $tot = 0;
      
      $registros = DB::table('empresas')
                    ->leftJoin('setores', 'empresas.setor_id', '=', 'setores.id')
                    ->whereRaw('CAST(empresas.updated_at AS DATE) BETWEEN ? AND ?', [$ini, $fim])
                    ->groupby('setores.descricao')
                    ->select(DB::raw('setores.descricao, COUNT(empresas.cnpj) AS quantidade'))
                    ->get();
          
      if (!empty($registros->first())) {
          foreach ($registros as $key => $value) {
              $temp = $html_linha_tabela_todos;
              $temp = str_replace('#####SETOR#####', $value->descricao, $temp);
              $temp = str_replace('#####QUANTIDADE#####', $value->quantidade, $temp);
              $conteudo .= $temp;
          }

          $registros = DB::table('empresas')
                    ->leftJoin('setores', 'empresas.setor_id', '=', 'setores.id')
                    ->whereRaw('CAST(empresas.updated_at AS DATE) BETWEEN ? AND ?', [$ini, $fim])
                    ->select(DB::raw('COUNT(empresas.cnpj) AS total'))
                    ->get();
          $tot = $registros->first()->total;

          $tabela = str_replace('#####LINHAS#####', $conteudo, $html_linha_header_todos);
      }
      else{    
        return response()->view('errors.relatorio_erro');
      }

      $html = str_replace('#####CONTEUDO#####', $tabela, RelatorioController::html_servico);
      $html = str_replace('#####TITULO#####','Empresas X Setor', $html);
      $html = str_replace('#####TOTAL#####', $tot, $html);
      $html = str_replace('#####INI#####', $ini, $html);
      $html = str_replace('#####FIM#####', $fim, $html);
      $html = str_replace('#####RODAPE#####', 'TOTAL DE EMPRESAS', $html);
      $mpdf = new \Mpdf\Mpdf();
      $mpdf->WriteHTML($html);
      $mpdf->Output();
    }
}
