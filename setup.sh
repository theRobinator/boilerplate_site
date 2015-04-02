#! /usr/bin/env bash

if [ "$1" == '' ]; then
    echo "Usage: $(basename $0) environment_name"
    exit 1
fi

if [ ! -e "environments/$1" ]; then
    echo 'That environment does not exist'
    exit 1
fi

rm -f config
ln -s environments/$1 config
