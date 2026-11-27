# Kubernetes

Everything needed to run Donn Larso Valer on a Flux cluster. Each push to
`main` builds `ghcr.io/kim1t/donn-larso-valer:<commit sha>` and `:latest`.
Flux follows `latest` by digest and commits the new image here.

## Layout

- `base/`: the app (Deployment, Service, Certificate, IngressRoute).
- `overlays/production/`: namespace, secret and volume for
  `https://donn-lar-so-valer.brunobernard.dev`.
- `overlays/preview/`: one pull request preview, rendered by the preview
  workflow.
- `flux/`: the Flux objects that apply production and the previews, and the
  image automation.

## Connect this repository to a cluster

1. Put the age key in the `sops-age` Secret in `flux-system`.
2. Create a GitRepository named `donn-larso-valer` in `flux-system` that
   points to this repository, branch `main`, with a credential that can
   push, such as a deploy key with write access. Put the same credential in
   the Secret `donn-larso-valer-repo-auth`.
3. Create one Flux `Kustomization` with `path: ./kubernetes`, `sourceRef` set
   to that GitRepository, and `decryption` using `sops-age`.

Production runs as one pod with SQLite on a 1Gi volume.

## Previews

Add the `preview` label to a pull request. The preview workflow builds the
branch, publishes it to the `previews` branch, and comments the URL
`https://donn-lar-so-valer-pr-<number>.brunobernard.dev` on the pull request.
Each preview starts with an empty database. Removing the label or closing the
pull request deletes the preview. At most 3 previews run at the same time.
