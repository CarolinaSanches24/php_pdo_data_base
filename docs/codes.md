##### Recuperação de informações de estudantes e seus telefones de um banco de dados

1. Função hydrateStudentList
Esta função pega os dados de estudantes que foram buscados do banco de dados e os transforma em objetos da classe Student.

Entrada: Recebe um objeto $stmt, que é o resultado de uma consulta ao banco de dados.
Processo:
Usa fetchAll() para obter todos os resultados da consulta como um array de dados de estudantes.
Cria um array vazio chamado $studentList para armazenar os estudantes que serão transformados em objetos.
Para cada estudante nos dados retornados, cria um novo objeto Student com as informações de nome, data de nascimento e id do estudante.
Para cada estudante, também chama uma função chamada fillPhonesOf, que irá buscar e adicionar os telefones associados a esse estudante.
Depois de preencher os telefones, o estudante é adicionado ao array $studentList.
Saída: Retorna a lista de objetos Student preenchida com seus dados e telefones.

```php
private function hydrateStudentList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll();
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $student = new Student(
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date']),
                $studentData['id']
            );

            $this->fillPhonesOf($student);
            $studentList[] = $student;
    }

    return $studentList;
    }
```
2. Função fillPhonesOf
Esta função adiciona os telefones de um estudante específico.

Entrada: Recebe um objeto Student, que é o estudante para o qual vamos buscar os telefones.
Processo:
Cria uma consulta SQL para buscar os telefones no banco de dados que estejam associados ao student_id (id do estudante).
Prepara a consulta e define o valor do student_id para buscar os dados corretos no banco de dados.
Executa a consulta, que retorna uma lista de telefones associados a esse estudante.
Para cada telefone encontrado, cria um objeto Phone com as informações de id, código de área e número de telefone.
Adiciona cada telefone ao objeto Student chamando o método addPhone.
Resumo do fluxo:
Recuperar estudantes do banco de dados: A função hydrateStudentList pega todos os estudantes e transforma cada linha de dados do banco em um objeto Student.
Adicionar telefones a cada estudante: Para cada estudante, a função fillPhonesOf faz uma nova consulta no banco para encontrar os telefones associados e adicioná-los ao objeto Student.
Resultado final: No final, você tem uma lista de objetos Student, cada um contendo seus dados (nome, data de nascimento, id) e seus telefones.

```php
 private function fillPhonesOf(Student $student):void{
        $sqlQuery = "SELECT id, area_code, number_phone FROM telefones WHERE student_id = ?";
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $student->id(), PDO::PARAM_INT);
        $stmt->execute();

        $phoneDataList = $stmt->fetchAll();

        foreach($phoneDataList as $phoneData){
            $phone = new Phone(
                $phoneData['id'],
                $phoneData['area_code'],
                $phoneData['number_phone']
            );

            $student->addPhone($phone);
        }

    }
```