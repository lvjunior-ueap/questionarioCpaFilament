<?php

namespace Database\Seeders;

use App\Models\Survey;
use App\Models\Dimension;
use App\Models\Question;
use App\Enums\AudienceType;
use App\Enums\QuestionType;
use Illuminate\Database\Seeder;

class GestaoSurvey2026Seeder extends Seeder
{
    public function run(): void
    {
        $survey = Survey::create([
            'name' => 'CPA Gestão 2026',
            'audience' => AudienceType::GESTAO,
            'year' => 2026,
            'version' => 1,
            'is_active' => true,
            'intro_text' => <<<TEXT
Prezado(a) Gestor (coordenador, chefe de divisão, pró-reitor, reitor),

Este questionário integra parte do processo de avaliação institucional da Universidade do Estado do Amapá (UEAP). Trata-se de um instrumento de autoavaliação exigido pelo Sistema Nacional de Avaliação da Educação Superior (Sinaes), do Ministério da Educação, que visa produzir conhecimentos que colaborem para o aperfeiçoamento da instituição. A autoavaliação da UEAP é coordenada pela Comissão Própria de Avaliação (CPA) e refere-se ao ano de 2025. Sua participação será breve, anônima e de extrema relevância. Tente responder de modo mais sincero e exato possível.
TEXT
        ]);

        /*
        |--------------------------------------------------------------------------
        | Perguntas Gerais (fora de dimensão)
        |--------------------------------------------------------------------------
        */

        $vinculo = $survey->questions()->create([
            'dimension_id' => null,
            'text' => 'Atualmente tem um vínculo com a UEAP?',
            'type' => QuestionType::RADIO,
            'required' => true,
            'order' => 1,
        ]);

        $this->createOptions($vinculo, [
            'Não',
            'Sim',
        ]);

        $campus = $survey->questions()->create([
            'dimension_id' => null,
            'text' => 'Campus que frequenta',
            'type' => QuestionType::RADIO,
            'required' => true,
            'order' => 2,
        ]);

        $this->createOptions($campus, [
            'Macapá',
            'Território dos Lagos (CTL) - Amapá',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Dimensão I – Missão e Plano de Desenvolvimento Institucional (PDI)
        |--------------------------------------------------------------------------
        */

        $dimension1 = $survey->dimensions()->create([
            'name' => 'Dimensão I – Missão e Plano de Desenvolvimento Institucional (PDI)',
            'order' => 1,
        ]);

        $indicadoresDim1 = [
            'Conheço a missão da UEAP.',
            'A missão institucional é clara.',
            'A missão institucional orienta as decisões da gestão no meu setor/unidade.',
            'Conheço o plano de desenvolvimento anual.',
            'Conheço o PDI vigente.',
            'As ações desenvolvidas pelo meu setor/unidade estão alinhadas às diretrizes e metas previstas no PDI.',
            'O PDI é utilizado como instrumento efetivo de planejamento.',
        ];

        foreach ($indicadoresDim1 as $index => $texto) {

            $question = $dimension1->questions()->create([
                'survey_id' => $survey->id,
                'text' => $texto,
                'type' => QuestionType::LIKERT,
                'required' => true,
                'order' => $index + 1,
            ]);

            $this->createLikertScale7($question);
        } //fim 1

        /*
        |--------------------------------------------------------------------------
        | Dimensão II – Política para o ensino, a pesquisa, a pós-graduação e a extensão
        |--------------------------------------------------------------------------
        */

        $dimension2 = $survey->dimensions()->create([
            'name' => 'Dimensão II – Política para o ensino, a pesquisa, a pós-graduação e a extensão',
            'order' => 2,
        ]);

        $indicadoresDim2 = [
            'As políticas e as estratégias de ensino, pesquisa e extensão da UEAP são executadas de forma interligada.',
            'As políticas de ensino da UEAP são claras.',
            'As políticas de pós-graduação e pesquisa da UEAP são claras.',
            'As políticas de extensão da UEAP são claras.',
            'O comitê de ensino é atuante - CEG.',
            'O comitê de pesquisa e pós-graduação é atuante - CPPG.',
            'O comitê de extensão é atuante - CAEXT.',
            'O Programa de bolsas de monitoria atende à comunidade acadêmica de forma satisfatória - PROMONITORIA.',
            'O Programa de bolsas de iniciação à docência atende à comunidade acadêmica de forma satisfatória - PIBID.',
            'O Programa de bolsas de iniciação científica atende à comunidade acadêmica de forma satisfatória - PIBIC.',
            'O Programa de bolsas de extensão atende à comunidade acadêmica de forma satisfatória - PIBEXT.',
            'A UEAP fornece os seguros das aulas de campo, estágio obrigatório e práticas pedagógicas de forma satisfatória.',
            'O programa de implementação de pós-graduação atende à comunidade acadêmica de forma satisfatória.',
            'A disponibilidade de insumos/material para utilização em atividades de pesquisa atende à comunidade acadêmica de forma satisfatória.',
            'Existem mecanismos institucionais de estímulo à produção acadêmica (por exemplo: editais, bolsas, apoio técnico e/ou financeiro, dentre outros).',
            'Os mecanismos institucionais de estímulo à produção acadêmica são satisfatórios.',
            'Os mecanismos institucionais de estímulo à produção acadêmica são divulgados.',
            'Há políticas para garantir o acesso satisfatório a periódicos científicos em plataformas digitais.',
            'O programa de auxílio à participação em eventos científicos me atende de forma satisfatória.',
            'Os programas de intercâmbio e internacionalização são divulgados.',
            'Os programas de intercâmbio e internacionalização são satisfatórios.',
            'Há ampla divulgação das atividades do Comitê de Ética na Pesquisa envolvendo Seres Humanos (CEP).',
            'Há ampla divulgação das atividades do Comitê de Salva Guarda da UEAP.',
        ];

        foreach ($indicadoresDim2 as $index => $texto) {

            $question = $dimension2->questions()->create([
                'survey_id' => $survey->id,
                'text' => $texto,
                'type' => QuestionType::LIKERT,
                'required' => true,
                'order' => $index + 1,
            ]);

            $this->createLikertScale7($question);
        } //fim2

        /*
        |--------------------------------------------------------------------------
        | Dimensão III – Responsabilidade social da instituição
        |--------------------------------------------------------------------------
        */

        $dimension3 = $survey->dimensions()->create([
            'name' => 'Dimensão III – Responsabilidade social da instituição',
            'order' => 3,
        ]);

        $indicadoresDim3 = [
            'As atividades da UEAP contribuem para o desenvolvimento social (cultural, econômico e/ou ambiental).',
            'As atividades da UEAP contribuem para a melhoria na qualidade de vida da comunidade de forma satisfatória.',
            'As atividades da UEAP contribuem para a sustentabilidade ambiental de forma satisfatória.',
            'As atividades da UEAP demonstram acessibilidade às pessoas com deficiência (PcD) de forma satisfatória.',
            'As atividades da UEAP demonstram acessibilidade às pessoas LGBTQIAPN+ de forma satisfatória.',
            'As atividades da UEAP fomentam a inclusão das relações étnico-raciais de forma satisfatória.',
            'A UEAP possui parcerias com outras instituições públicas e privadas em benefício da comunidade.',
            'As atividades da UEAP fomentam a solidariedade e o respeito pelas diferenças.',
            'Os processos de seleção das atividades propostas pela UEAP são transparentes.',
        ];

        foreach ($indicadoresDim3 as $index => $texto) {

            $question = $dimension3->questions()->create([
                'survey_id' => $survey->id,
                'text' => $texto,
                'type' => QuestionType::LIKERT,
                'required' => true,
                'order' => $index + 1,
            ]);

            $this->createLikertScale7($question);
        } //fim 3

        








        
        private function createOptions(Question $question, array $labels): void
        {
            foreach ($labels as $index => $label) {
                $question->options()->create([
                    'label' => $label,
                    'value' => $index + 1,
                    'order' => $index + 1,
                ]);
            }
        }
    
        private function createLikertScale7(Question $question): void
        {
            $labels = [
                'Não sei',
                'Não se aplica',
                'Discordo totalmente',
                'Discordo parcialmente',
                'Indiferente',
                'Concordo parcialmente',
                'Concordo totalmente',
            ];
    
            $this->createOptions($question, $labels);
        }
    
        private function createLikertScale6SemNSA(Question $question): void
        {
            $labels = [
                'Não sei',
                'Discordo totalmente',
                'Discordo parcialmente',
                'Indiferente',
                'Concordo parcialmente',
                'Concordo totalmente',
            ];
    
            foreach ($labels as $index => $label) {
                $question->options()->create([
                    'label' => $label,
                    'value' => $index + 1,
                    'order' => $index + 1,
                ]);
            }
        }
    }