#!/usr/bin/env bash
uid=$(mktemp -u)
uid2=$(mktemp -u)
git clone git@github.com:CodeBlock/php-fas $uid
pushd $uid
  diviner .
  rm -rf .divinercache
  git checkout gh-pages
  mv docs/ $uid2
  git rm -rf $uid/*
  mv $uid2/* .  
  git add .
  git commit -m "Deploying documentation at `date`"
  git push origin gh-pages
popd
rm -rf $uid $uid2
