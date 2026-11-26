# Kubernetes

Everything needed to run Donn Larso Valer on a Flux cluster. Each push to
`main` builds `ghcr.io/kim1t/donn-larso-valer:<commit sha>` and `:latest`.
Flux follows `latest` by digest and commits the new image here.

## Connect this repository to a cluster

1. Put the age key in the `sops-age` Secret in `flux-system`.
2. Create a GitRepository named `donn-larso-valer` in `flux-system` that
   points to this repository, branch `main`, with a credential that can
   push, such as a deploy key with write access.
3. Create one Flux `Kustomization` with `path: ./kubernetes`, `sourceRef` set
   to that GitRepository, and `decryption` using `sops-age`.

The app runs as one pod with SQLite on a 1Gi volume, at
`https://donn-lar-so-valer.brunobernard.dev`.
