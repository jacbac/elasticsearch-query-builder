<?php

namespace Erichard\ElasticQueryBuilder\Filter;

use Erichard\ElasticQueryBuilder\QueryException;

class FuzzyFilter extends Filter
{
    protected $field;
    protected $value;
    protected $fuzziness;
    protected $maxExpansions;
    protected $prefixLength;
    protected $transpositions;
    protected $rewrite;

    public function setField(string $field)
    {
        $this->field = $field;

        return $this;
    }

    public function setValue(string $value)
    {
        $this->value = $value;

        return $this;
    }

    public function setFuzziness(string $fuzziness)
    {
        $this->fuzziness = $fuzziness;

        return $this;
    }

    public function setMaxExpansions(int $maxExpansions)
    {
        $this->maxExpansions = $maxExpansions;

        return $this;
    }

    public function setPrefixLength(int $prefixLength)
    {
        $this->prefixLength = $prefixLength;

        return $this;
    }

    public function setTranspositions(bool $transpositions)
    {
        $this->transpositions = $transpositions;

        return $this;
    }

    public function setRewrite(string $rewrite)
    {
        $this->rewrite = $rewrite;

        return $this;
    }

    public function build(): array
    {
        if (null === $this->field && null === $this->value) {
            throw new QueryException('You need to call setField() and setValue() on'.__CLASS__);
        }

        $query = [
            'fuzzy' => [
                $this->field => [
                    'value' => $this->value,
                ],
            ],
        ];

        if (null !== $this->fuzziness) {
            $query['fuzzy'][$this->field]['fuzziness'] = $this->fuzziness;
        }

        if (null !== $this->maxExpansions) {
            $query['fuzzy'][$this->field]['max_expansions'] = $this->maxExpansions;
        }

        if (null !== $this->prefixLength) {
            $query['fuzzy'][$this->field]['prefix_length'] = $this->prefixLength;
        }

        if (null !== $this->transpositions) {
            $query['fuzzy'][$this->field]['transpositions'] = $this->transpositions;
        }

        if (null !== $this->rewrite) {
            $query['fuzzy'][$this->field]['rewrite'] = $this->rewrite;
        }

        return $query;
    }
}
