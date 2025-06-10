<?php 
    require("fpdf.php");

    class PDF extends FPDF {
        function converteTexto($str) {
            return iconv("UTF-8", "windows-1252", $str);
        }

        function Header() {
            $this->SetFont('Arial','B',15);    
            $this->Cell(180,10,"Lista da Tabela",0,0,'C'); // Sem borda
            $this->Ln(20);    
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,'Página '.$this->PageNo().' de {nb}',0,0,'C');
        }

        function TabelaComBordas($cabecalhos, $dados) {
            $alturaCelulaTexto = 10;
            $alturaCelulaImagem = 20;
            $margemImagem = 3;
            $contadorLinha = 0; // Para alternar cores das linhas

            // Título sem borda
            $this->SetFont('Arial', 'B', 14);
            $this->Cell(0, 10, $this->converteTexto("Dados da Empresa"), 0, 1, 'C');
            $this->Ln(5);

            // Filtra colunas indesejadas
            $cabecalhosFiltrados = array_filter($cabecalhos, function($coluna) {
                return !in_array(strtolower($coluna), ['senha', 'password', 'modified', 'created', 'mobile','descricao','genero','data_modified','data_created','ie']);
            });

            $numColunas = count($cabecalhosFiltrados);
            $larguraPagina = $this->GetPageWidth() - $this->lMargin - $this->rMargin;
            $larguraCelula = $larguraPagina / $numColunas;

            // Cabeçalho da tabela estilizado
            $this->SetFont('Arial', 'B', 14);
            $this->SetFillColor(30, 60, 120); // Azul escuro
            $this->SetTextColor(255); // Texto branco

            foreach ($cabecalhosFiltrados as $coluna) {
                $this->Cell($larguraCelula, $alturaCelulaTexto, $this->converteTexto(ucfirst($coluna)), 0, 0, 'C', true); // Sem bordas
            }
            $this->Ln();

            // Restaura cor padrão para texto
            $this->SetTextColor(0); // Preto

            // Dados
            $this->SetFont('Arial', '', 8);
            foreach ($dados as $linha) {
                $maxAlturaLinha = $alturaCelulaTexto;

                // Define cores alternadas para as linhas
                if ($contadorLinha % 2 == 0) {
                    $this->SetFillColor(173, 216, 230); // Azul claro
                } else {
                    $this->SetFillColor(173, 173, 173); // n Branco
                }
                $contadorLinha++;

                // Calcula a altura máxima da linha
                foreach ($cabecalhosFiltrados as $coluna) {
                    if (strtolower($coluna) === 'foto') {
                        $maxAlturaLinha = max($maxAlturaLinha, $alturaCelulaImagem);
                    } else {
                        $texto = $this->converteTexto($linha[$coluna] ?? '');
                        $numLinhas = ceil($this->GetStringWidth($texto) / ($larguraCelula - 2));
                        $alturaTexto = $alturaCelulaTexto * $numLinhas;
                        $maxAlturaLinha = max($maxAlturaLinha, $alturaTexto);
                    }
                }

                $yInicial = $this->GetY(); // Armazena a posição Y inicial da linha

                foreach ($cabecalhosFiltrados as $coluna) {
                    if (strtolower($coluna) === 'foto') {
                        $imgPath = "img/" . $linha[$coluna];
                        $x = $this->GetX();

                        $this->Cell($larguraCelula, $maxAlturaLinha, '', 0, 0, '', true); // Sem bordas, com preenchimento

                        if (file_exists($imgPath)) {
                            list($wOrig, $hOrig) = getimagesize($imgPath);
                            $escala = min(
                                ($larguraCelula - $margemImagem) / $wOrig,
                                ($maxAlturaLinha - $margemImagem) / $hOrig
                            );
                            $wFinal = $wOrig * $escala;
                            $hFinal = $hOrig * $escala;
                            $imgX = $x + ($larguraCelula - $wFinal) / 2;
                            $imgY = $yInicial + ($maxAlturaLinha - $hFinal) / 2;
                            $this->Image($imgPath, $imgX, $imgY, $wFinal, $hFinal);
                        } else {
                            $this->SetXY($x, $yInicial);
                            $this->Cell($larguraCelula, $maxAlturaLinha, 'Imagem não encontrada', 0, 0, 'C', true);
                        }
                    } else {
                        $texto = $this->converteTexto($linha[$coluna] ?? '');
                        $x = $this->GetX();
                        $this->Cell($larguraCelula, $maxAlturaLinha, $texto, 0, 0, 'C', true); // Usa Cell com altura fixa
                        $this->SetXY($x + $larguraCelula, $yInicial); // Move para a próxima célula na mesma linha
                    }
                }
                $this->Ln($maxAlturaLinha); // Avança para a próxima linha
            }
        }
    }
?>

D