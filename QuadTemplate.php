<?php

/*
 * The MIT License
 *
 * Copyright 2021 zozlak.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace dumbrdf;

use rdfInterface\NamedNode as iNamedNode;
use rdfInterface\BlankNode as iBlankNode;
use rdfInterface\Literal as iLiteral;
use rdfInterface\Quad as iQuad;
use rdfInterface\QuadTemplate as iQuadTemplate;
use rdfHelpers\DefaultGraph;

/**
 * Description of QuadTemplate
 *
 * @author zozlak
 */
class QuadTemplate extends Quad implements iQuadTemplate {

    public function __construct(iNamedNode|iBlankNode|iQuad|null $subject,
                                iNamedNode|null $predicate,
                                iNamedNode|iBlankNode|iLiteral|iQuad|null $object,
                                iNamedNode|null $graphIri = null) {
        $this->subject   = $subject;
        $this->predicate = $predicate;
        $this->object    = $object;
        $this->graphIri  = $graphIri ?? new DefaultGraph();
    }

    public function equals(\rdfInterface\Term $term): bool {
        /* @var $term iQuad*/
        return $term->getType() === \rdfInterface\TYPE_QUAD &&
            ($this->subject === null || $this->subject->equals($term->getSubject())) &&
            ($this->predicate === null || $this->predicate->equals($term->getPredicate())) &&
            ($this->subject === null || $this->subject->equals($term->getSubject())) &&
            ($this->graphIri === null || $this->graphIri->equals($term->getGraphIri()));
    }

    public function getType(): string {
        return \rdfInterface\TYPE_QUAD_TMPL;
    }

    public function withSubject(iNamedNode|iBlankNode|iQuad|null $subject): iQuad {
        $quad          = clone $this;
        $quad->subject = $subject;
        return $quad;        
    }

    public function withPredicate(iNamedNode|null $predicate): iQuad {
        $quad         = clone $this;
        $quad->object = $object;
        return $quad;
    }

    public function withObject(iNamedNode|iBlankNode|iLiteral|iQuad|null $object): iQuad {
        $quad         = clone $this;
        $quad->object = $object;
        return $quad;
    }

}