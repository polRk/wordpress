#!/bin/sh

rm -rf ./WordPress
git clone --depth 1 https://github.com/WordPress/WordPress.git
rm -rf ./WordPress/.git
