#!/usr/bin/env bash
uid=$(mktemp -u)
git clone git@github.com:CodeBlock/php-fas $uid
pushd $uid
  diviner .
  rm -rf .divinercache
  git checkout gh-pages
  mv docs/* .
  rmdir docs
  git add .
  git commit -m "Deploying documentation at `date`"
  git push origin gh-pages
popd
