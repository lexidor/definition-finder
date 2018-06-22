<?hh // strict
/*
 *  Copyright (c) 2015-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

namespace Facebook\DefinitionFinder;

use namespace Facebook\HHAST;
use namespace HH\Lib\{Str, Vec};

function name_from_ast(
  HHAST\EditableNode $node,
): string {
  if ($node instanceof HHAST\EditableToken) {
    return $node->getText();
  }
  if ($node instanceof HHAST\QualifiedName) {
    return _Private\items_of_type($node->getParts(), HHAST\EditableToken::class)
      |> Vec\map($$, $x ==> $x->getText())
      |> Str\join($$, '');
  }

  invariant_violation(
    "Expected EditableToken or QualifiedName, got %s",
    \get_class($node),
  );
}
