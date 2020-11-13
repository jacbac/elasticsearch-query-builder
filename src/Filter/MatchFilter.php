<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\QueryException;

class MatchFilter extends Filter
{
    protected $field;
    protected $query;
    protected $operator;
    protected $analyzer;

    public function setField(string $field)
    {
        $this->field = $field;

        return $this;
    }

    public function setQuery(string $query)
    {
        $this->query = $query;

        return $this;
    }

    public function setOperator(string $operator)
    {
        $this->operator = $operator;

        return $this;
    }

    public function setAnalyzer(string $analyzer)
    {
        $this->analyzer = $analyzer;

        return $this;
    }

    public function build(): array
    {
        if (null === $this->query) {
            throw new QueryException('You need to call setQuery() on'.__CLASS__);
        }

        $query = [
            'match' => [
                $this->field => [
                    'query' => $this->query,
                ],
            ],
        ];

        if (null !== $this->operator) {
            $query['match'][$this->field]['operator'] = $this->operator;
        }

        if (null !== $this->analyzer) {
            $query['match'][$this->field]['analyzer'] = $this->analyzer;
        }

        return $query;
    }
}
