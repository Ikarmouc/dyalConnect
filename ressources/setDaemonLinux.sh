#!/bin/bash 

cat <<EOF | sudo tee /etc/docker/daemon.json
{
    "insecure-registries:[
        "registry.univ-lr.fr:81",
        "registry.univ-lr.fr:80"
    ]
}
EOF 

