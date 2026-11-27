#!/bin/sh
set -eu

marker='<!-- preview -->'
body="$marker
$1"

id=$(gh api "repos/$GITHUB_REPOSITORY/issues/$PR/comments" --paginate \
    --jq ".[] | select(.body | startswith(\"$marker\")) | .id" | head -n 1)

if [ -n "$id" ]; then
    gh api -X PATCH "repos/$GITHUB_REPOSITORY/issues/comments/$id" -f body="$body" >/dev/null
else
    gh api -X POST "repos/$GITHUB_REPOSITORY/issues/$PR/comments" -f body="$body" >/dev/null
fi
