add_action('init', 'start_session', 1);
function start_session() {
    if (!session_id()) {
        session_start();
    }
}

// Função para processar o formulário via AJAX e retornar valores
function processar_formulario_ajax() {
    if (isset($_POST['data'])) {
        parse_str($_POST['data'], $form_data);

        $a = isset($form_data['number-impressoras']) ? intval($form_data['number-impressoras']) : 0;
        $e = isset($form_data['number-preto-branco']) ? intval($form_data['number-preto-branco']) : 0;
        $b = isset($form_data['number-modelos']) ? intval($form_data['number-modelos']) : 0;
        $c = isset($form_data['suprimentos-originais']) && $form_data['suprimentos-originais'] == "Sim";
        $d = isset($form_data['gestao-impressao']) && $form_data['gestao-impressao'] == "Sim";

        $t = 0;

        if ($a >= 500000) {
            $t += 25;
        }

        if ($b >= 50000) {
            $t += 25;
        }

        if (!$c) {
            $t += 25;
        }

        if (!$d) {
            $t += 25;
        }

        $image_url = '';

        switch ($t) {
            case 0:
            case 25:
                $image_url = 'http://an1-homologacao.com.br/printerzilla/wp-content/uploads/2024/05/Group-117.png';
                break;
            case 50:
                $image_url = 'http://an1-homologacao.com.br/printerzilla/wp-content/uploads/2024/05/Group-115.png';
                break;
            case 75:
                $image_url = 'http://an1-homologacao.com.br/printerzilla/wp-content/uploads/2024/05/Group-112.png';
                break;
            case 100:
                $image_url = 'http://an1-homologacao.com.br/printerzilla/wp-content/uploads/2024/05/Group-113.png';
                break;
            default:
                $image_url = 'Pontuação inválida';
        }

        function custo($a, $b, $e, $c, $d) {
            $c = ($c == "Sim") ? 0 : 0.05;
            $d = ($d == "Sim") ? 0 : 0.30;

            $energia = ($a + $e) * 0.0076;
            $papel = ($a + $e) * 0.060;
            $pb = $a * 0.07;
            $cor = $e * 0.45;
            $porcentagem = $c + $d;
            if($porcentagem > 0){
                $final = ($energia * $porcentagem) + ($papel * $porcentagem) + ($pb * $porcentagem) + ($cor * $porcentagem);
            }else {
                $final = $energia;
            }
            return $final;
        }

        function falha($c, $d){
            $c = ($c == "Sim") ? 5 : 5;
            $d = ($d == "Sim") ? 0 : 30;
            $falha = $c + $d;
            return $falha;
        }

        function desperdicio ($c, $d){
            $c = ($c == "Sim") ? 5 : 5;
            $d = ($d == "Sim") ? 0 : 30;
            $desperdicio = $c + $d;
            return $desperdicio;
        }

        function falta($c, $d){
            $c = ($c == "Sim") ? 5 : 5;
            $d = ($d == "Sim") ? 0 : 30;
            $falta = $c + $d;
            return $falta;
        }

        $valor_final = custo($a, $b, $e, $c, $d);
        $valor_falta = falta($c , $d);
        $valor_desperdicio = desperdicio($c , $d);
        $valor_falha = falha($c , $d);

        // Gera a resposta em JSON
        $response = array(
            'impressoras' => $a,
            'modelos' => $b,
            'image' => $image_url,
            'valor_impressao' => number_format($a + $e, 2, ',', '.'),
            'valor_final' => number_format($valor_final, 2, ',', '.'),
            'valor_falta' => number_format($valor_falta, 2, ',', '.'),
            'valor_desperdicio' => number_format($valor_desperdicio, 2, ',', '.'),
            'valor_falha' => number_format($valor_falha, 2, ',', '.')
        );

        echo json_encode($response);

        die();
    }
}
add_action('wp_ajax_processar_formulario', 'processar_formulario_ajax');
add_action('wp_ajax_nopriv_processar_formulario', 'processar_formulario_ajax');

// Shortcode para exibir a quantidade de impressoras
function shortcode_valor_final() {
    return '<span id="valor_final">0</span>'; // Valor inicial
}
add_shortcode('valor_final', 'shortcode_valor_final');

// Shortcode para exibir a quantidade de impressoras
function shortcode_quantidade_impressoras() {
    return '<span id="quantidade_impressoras">0</span>'; // Valor inicial
}
add_shortcode('quantidade_impressoras', 'shortcode_quantidade_impressoras');

// Shortcode para exibir a quantidade de modelos
function shortcode_quantidade_modelos() {
    return '<span id="quantidade_modelos">0</span>'; // Valor inicial
}
add_shortcode('quantidade_modelos', 'shortcode_quantidade_modelos');

// Shortcode para calcular e exibir o valor de impressão
function shortcode_valor_impressao() {
    return '<span id="valor_impressao">0,00</span>'; // Valor inicial padrão
}
add_shortcode('valor_impressao', 'shortcode_valor_impressao');

// Shortcode para calcular e exibir o valor de economia
function shortcode_valor_desconto() {
    return '<span id="valor_desconto">0,00</span>'; // Valor inicial padrão
}
add_shortcode('valor_desconto', 'shortcode_valor_desconto');

// Shortcode para exibir valor de falta
function shortcode_valor_falta() {
    return '<span id="valor_falta">0,00</span>'; // Valor inicial padrão
}
add_shortcode('valor_falta', 'shortcode_valor_falta');

// Shortcode para exibir valor de desperdicio
function shortcode_valor_desperdicio() {
    return '<span id="valor_desperdicio">0,00</span>'; // Valor inicial padrão
}
add_shortcode('valor_desperdicio', 'shortcode_valor_desperdicio');

// Shortcode para exibir valor de falha
function shortcode_valor_falha() {
    return '<span id="valor_falha">0,00</span>'; // Valor inicial padrão
}
add_shortcode('valor_falha', 'shortcode_valor_falha');

// Função que adiciona o script personalizado ao rodapé
function adicionar_script_personalizado() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#formulario_analise_form').submit(function(event) {
                event.preventDefault(); // Evita que o formulário recarregue a página

                var formValid = true;

                $('#formulario_analise_form').find('input[required]').each(function() {
                    if ($(this).val() === '' || $(this).val() === '0') {
                        formValid = false;
                        $(this).css('border', '2px solid red');
                    } else {
                        $(this).css('border', '');
                    }
                });

                if (!formValid) {
                    alert('Por favor, preencha todos os campos obrigatórios.');
                    return;
                }

                var formData = $(this).serialize(); // Coleta os dados do formulário

                // Envia os dados do formulário via AJAX
                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: {
                        'action': 'processar_formulario',
                        'data': formData
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('#quantidade_impressoras').text(data.impressoras);
                        $('#quantidade_modelos').text(data.modelos);

                        if (data.image) {
                            $('#imagem_resultado').html('<img src="' + data.image + '" alt="Resultado">');
                        } else {
                            $('#imagem_resultado').html('<p>' + data.image + '</p>');
                        }

                        $('#valor_impressao').text(data.valor_impressao);
                        $('#valor_desconto').text(data.valor_desconto);
                        $('#valor_final').text(data.valor_final);

                        $('#valor_falha').text(data.valor_falha);
                        $('#valor_desperdicio').text(data.valor_desperdicio);
                        $('#valor_falta').text(data.valor_falta);

                        // Atualiza o valor final no elemento com ID valor_final
                        $('#valor_final').text(data.valor_final);

                        // Exibe a imagem de resultado e o formulário Contact Form 7
                        $('#imagem_resultado').css('display', 'block');
                        $('#contact_form_7').css('display', 'block');
                        $('#texto_contato').css('display', 'block');

                        // Rola a página até a imagem e o formulário em 1 segundo
                        $('html, body').animate({
                            scrollTop: $("#imagem_resultado").offset().top
                        }, 1000);
                    }
                });
            });

            // Lida com a submissão do formulário Contact Form 7
            document.addEventListener('wpcf7mailsent', function(event) {
                $('.escondidos').css('display', 'block');
            }, false);
        });
    </script>
    <?php
}
add_action('wp_footer', 'adicionar_script_personalizado');

function processar_formulario_shortcode() {
    ob_start(); ?>
    <div id="formulario_analise_shortcode">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <style>
            #formulario_analise_form {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
            .form-group {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-bottom: 15px;
            }
            #imagem_resultado {
                margin-top: 1rem;
            }
            .form-group label {
                margin-bottom: 0.5rem;
            }
            .ui-slider {
                width: 80%;
                margin-top: 0.5rem;
            }
            .ui-slider .ui-slider-handle {
                width: 2rem;
                height: 2rem;
                background-color: #28a745;
                border-radius: 50%;
                top: -0.8rem;
            }
            .ui-slider .ui-slider-range {
                background-color: #28a745;
            }
            .ui-slider-horizontal .ui-slider-handle {
                margin-left: -1rem;
            }
            .slider-value {
                font-size: 2rem;
                color: #28a745;
                font-weight: bold;
                text-align: center;
                width: 3rem;
                border-radius: 0.5rem;
                margin-top: 0.5rem;
            }
            .checkbox-group {
                display: flex;
                align-items: center;
                gap: 1rem;
            }
            .checkbox-group label {
                font-size: 1rem;
                color: #0486C0;
            }
            .checkbox-group input[type="radio"] {
                width: 1.5rem;
                height: 1.5rem;
            }
            .perguntasform {
                display: flex;
                flex-direction: column;
            }
            #sliderValue2, #sliderValue1, #sliderValue3 {
                border: none;
            }
            .escondidos {
                display: none;
            }
        </style>
        <form id="formulario_analise_form" method="post">
            <div class="form-group">
                <label for="slider1">Indique o seu volume de impressão Preto & Branco mensal? (0-1.000.000+):</label>
                <input type="text" id="sliderValue1" name="number-impressoras" readonly class="slider-value" required>
                <div id="slider1"></div>
            </div>

            <div class="form-group">
                <label for="slider3">Indique o seu volume de impressão Colorida mensal? (0-100.000+):</label>
                <input type="text" id="sliderValue3" name="number-preto-branco" readonly class="slider-value" required>
                <div id="slider3"></div>
            </div>

            <div class="form-group">
                <label for="slider2">Qual a quantidade de impressoras de seu parque de impressão? (De 0 a 500+):</label>
                <input type="text" id="sliderValue2" name="number-modelos" readonly class="slider-value" required>
                <div id="slider2"></div>
            </div>

            <script>
                $(function() {
                    $("#slider1").slider({
                        range: "min",
                        value: 0,
                        min: 0,
                        max: 1000000,
                        slide: function(event, ui) {
                            $("#sliderValue1").val(ui.value);
                        }
                    });
                    $("#sliderValue1").val($("#slider1").slider("value"));

                    $("#slider2").slider({
                        range: "min",
                        value: 0,
                        min: 0,
                        max: 500,
                        slide: function(event, ui) {
                            $("#sliderValue2").val(ui.value);
                        }
                    });
                    $("#sliderValue2").val($("#slider2").slider("value"));

                    $("#slider3").slider({
                        range: "min",
                        value: 0,
                        min: 0,
                        max: 100000,
                        slide: function(event, ui) {
                            $("#sliderValue3").val(ui.value);
                        }
                    });
                    $("#sliderValue3").val($("#slider3").slider("value"));
                });
            </script>

            <div class="perguntasform">
                <div class="form-group">
                    <label>Em sua operação são usados 100% de Suprimentos Originais?</label>
                    <div class="checkbox-group">
                        <input type="radio" id="suprimentos_sim" name="suprimentos-originais" value="Sim" required>
                        <label for="suprimentos_sim">Sim</label>
                        <input type="radio" id="suprimentos_nao" name="suprimentos-originais" value="Não" required>
                        <label for="suprimentos_nao">Não</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Em sua operação, você utiliza alguma solução de Gerenciamento do Recurso de Impressão, com relatórios, retenção de impressão ou política de uso dos recursos?</label>
                    <div class="checkbox-group">
                        <input type="radio" id="gestao_sim" name="gestao-impressao" value="Sim" required>
                        <label for="gestao_sim">Sim</label>
                        <input type="radio" id="gestao_nao" name="gestao-impressao" value="Não" required>
                        <label for="gestao_nao">Não</label>
                    </div>
                </div>
            </div>

            <div class="form-group3">
                <button type="submit" class="btnformformula">Descubra agora</button>
            </div>
        </form>
    </div>

    <div id="imagem_resultado" class="escondidos"></div>
    <div id="texto_contato" class="escondidos"><h2>Para saber mais, preencha seus dados</h2></div>
    <div id="contact_form_7" style="display:none;">
        <?php echo do_shortcode('[contact-form-7 id="46305c4" title="formula"]'); ?>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('#formulario_analise_form').submit(function(event) {
            event.preventDefault(); // Evita que o formulário recarregue a página

            var formValid = true;

            $('#formulario_analise_form').find('input[required]').each(function() {
                if ($(this).val() === '' || $(this).val() === '0') {
                    formValid = false;
                    $(this).css('border', '2px solid red');
                } else {
                    $(this).css('border', '');
                }
            });

            if (!formValid) {
                alert('Por favor, preencha todos os campos obrigatórios.');
                return;
            }

            var formData = $(this).serialize(); // Coleta os dados do formulário

            // Envia os dados do formulário via AJAX
            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {
                    'action': 'processar_formulario',
                    'data': formData
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#quantidade_impressoras').text(data.impressoras);
                    $('#quantidade_modelos').text(data.modelos);

                    if (data.image) {
                        $('#imagem_resultado').html('<img src="' + data.image + '" alt="Resultado">');
                    } else {
                        $('#imagem_resultado').html('<p>' + data.image + '</p>');
                    }

                    $('#valor_impressao').text(data.valor_impressao);
                    $('#valor_desconto').text(data.valor_desconto);
                    $('#valor_final').text(data.valor_final);

                    $('#valor_falha').text(data.valor_falha);
                    $('#valor_desperdicio').text(data.valor_desperdicio);
                    $('#valor_falta').text(data.valor_falta);

                    // Atualiza o valor final no elemento com ID valor_final
                    $('#valor_final').text(data.valor_final);

                    // Exibe a imagem de resultado e o formulário Contact Form 7
                    $('#imagem_resultado').css('display', 'block');
                    $('#contact_form_7').css('display', 'block');
                    $('#texto_contato').css('display', 'block');

                    // Rola a página até a imagem e o formulário em 1 segundo
                    $('html, body').animate({
                        scrollTop: $("#imagem_resultado").offset().top
                    }, 1000);
                }
            });
        });

        // Lida com a submissão do formulário Contact Form 7
        document.addEventListener('wpcf7mailsent', function(event) {
            $('.escondidos').css('display', 'block');
        }, false);
    });
    </script>
    <?php
}
add_shortcode('formulario_analise', 'processar_formulario_shortcode');

