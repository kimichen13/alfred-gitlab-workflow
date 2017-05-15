#!/bin/bash
METHOD="POST";
while true ; do
    case "$1" in
        -e )
            EMAIL=$2
            shift 2
        ;;
        -p )
            PASSWORD=$2
            shift 2
        ;;
        --url )
            URL=$2
            shift 2
        ;;
        *)
            break
        ;;
    esac 
done;

JSON="email=$EMAIL&password=$PASSWORD"

expect -c "
spawn curl -X $METHOD --data $JSON $URL
interact "
