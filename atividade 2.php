<?php for ($i = 1; $i <= 4; $i++): ?>
            Nota <?php echo $i; ?>: <input type="number" step="0.01" name="nota<?php echo $i; ?>"><br>
        <?php endfor; ?>
        <br>
        <h2>Área do Retângulo</h2>
        Largura (m): <input type="number" step="0.01" name="largura"><br>
        Comprimento (m): <input type="number" step="0.01" name="comprimento"><br>
        <br>
        <h2>Diferença entre Valores</h2>
        Valor 1: <input type="number" step="0.01" name="valor1"><br>
        Valor 2: <input type="number" step="0.01" name="valor2"><br>
        <br>
        <h2>Divisão de Valores</h2>
        Valor 1: <input type="number" step="0.01" name="div1"><br>
        Valor 2: <input type="number" step="0.01" name="div2"><br>
        <br>
        <h2>Peso em Gramas</h2>
        Peso (kg): <input type="number" step="0.01" name="pesoKg"><br>
        <br>
        <h2>Valor da Refeição</h2>
        Peso do prato (kg): <input type="number" step="0.01" name="pesoPrato"><br>
        <br>
        <h2>Conversão de Temperatura</h2>
        Temperatura (F): <input type="number" step="0.01" name="fahrenheit"><br>
        <br>
        <h2>Circunferência</h2>
        Raio: <input type="number" step="0.01" name="raio"><br>
        <br>
        <h2>Troca de Valores</h2>
        Valor A: <input type="number" name="valorA"><br>
        Valor B: <input type="number" name="valorB"><br>
        <br>
        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Funções PHP
        function calcularPontuacaoTotal($notas) {
            return array_sum($notas);
        }

        function calcularMedia($notas) {
            return array_sum($notas) / count($notas);
        }

        function calcularAreaRetangulo($largura, $comprimento) {
            return $largura * $comprimento;
        }

        function calcularDiferenca($valor1, $valor2) {
            return abs($valor1 - $valor2);
        }

        function calcularDivisao($valor1, $valor2) {
            if ($valor2 == 0) {
                return "Divisão por zero não é permitida.";
            }
            return $valor1 / $valor2;
        }

        function converterPesoParaGramas($pesoKg) {
            return $pesoKg * 1000;
        }

        function calcularValorRefeicao($pesoPrato) {
            $precoPorKg = 45.00;
            return $pesoPrato * $precoPorKg;
        }

        function converterFahrenheitParaCelsius($fahrenheit) {
            return ($fahrenheit - 32) / 1.8;
        }

        function calcularCircunferencia($raio) {
            $diametro = 2 * $raio;
            $comprimento = 2 * pi() * $raio;
            $area = pi() * pow($raio, 2);
            return [$diametro, $comprimento, $area];
        }

        function inverterValores($valorA, $valorB) {
            return [$valorB, $valorA];
        }

        // Notas do aluno
        $notas = [];
        for ($i = 1; $i <= 4; $i++) {
            if (isset($_POST["nota$i"])) {
                $notas[] = (float)$_POST["nota$i"];
            }
        }
        if (!empty($notas)) {
            echo "<h2>Notas do Aluno</h2>";
            echo "Pontuação total: " . calcularPontuacaoTotal($notas) . "<br>";
            echo "Média: " . calcularMedia($notas) . "<br>";
        }

        // Área do retângulo
        if (isset($_POST['largura']) && isset($_POST['comprimento'])) {
            $largura = (float)$_POST['largura'];
            $comprimento = (float)$_POST['comprimento'];
            echo "<h2>Área do Retângulo</h2>";
            echo "Área: " . calcularAreaRetangulo($largura, $comprimento) . " m²<br>";
        }

        // Diferença entre valores
        if (isset($_POST['valor1']) && isset($_POST['valor2'])) {
            $valor1 = (float)$_POST['valor1'];
            $valor2 = (float)$_POST['valor2'];
            echo "<h2>Diferença entre Valores</h2>";
            echo "Diferença: " . calcularDiferenca($valor1, $valor2) . "<br>";
        }

        // Divisão de valores
        if (isset($_POST['div1']) && isset($_POST['div2'])) {
            $div1 = (float)$_POST['div1'];
            $div2 = (float)$_POST['div2'];
            echo "<h2>Divisão de Valores</h2>";
            echo "Divisão: " . calcularDivisao($div1, $div2) . "<br>";
        }

        // Peso em gramas
        if (isset($_POST['pesoKg'])) {
            $pesoKg = (float)$_POST['pesoKg'];
            echo "<h2>Peso em Gramas</h2>";
            echo "Peso em gramas: " . converterPesoParaGramas($pesoKg) . " g<br>";
        }

        // Valor da refeição
        if (isset($_POST['pesoPrato'])) {
            $pesoPrato = (float)$_POST['pesoPrato'];
            echo "<h2>Valor da Refeição</h2>";
            echo "Valor a pagar: R$" . calcularValorRefeicao($pesoPrato) . "<br>";
        }

        // Conversão de temperatura
        if (isset($_POST['fahrenheit'])) {
            $fahrenheit = (float)$_POST['fahrenheit'];
            $celsius = converterFahrenheitParaCelsius($fahrenheit);
            echo "<h2>Conversão de Temperatura</h2>";
            echo "Temperatura: $celsius °C e $fahrenheit °F<br>";
        }

        // Circunferência
        if (isset($_POST['raio'])) {
            $raio = (float)$_POST['raio'];
            list($diametro, $comprimento, $area) = calcularCircunferencia($raio);
            echo "<h2>Circunferência</h2>";
            echo "Diâmetro: $diametro<br>";
            echo "Comprimento: $comprimento<br>";
            echo "Área: $area<br>";
        }

        // Troca de valores
        if (isset($_POST['valorA']) && isset($_POST['valorB'])) {
            $valorA = (int)$_POST['valorA'];
            $valorB = (int)$_POST['valorB'];
            list($novoValorA, $novoValorB) = inverterValores($valorA, $valorB);
            echo "<h2>Troca de Valores</h2>";
            echo "Valor antigo A: $valorA, Valor antigo B: $valorB<br>";
            echo "Novo valor A: $novoValorA, Novo valor B: $novoValorB<br>";
        }
    }