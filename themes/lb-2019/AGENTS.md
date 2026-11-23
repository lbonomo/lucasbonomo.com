# Theme agent instructions

When the user says "publish it" for this theme:

1. Update the theme version in `style.css`.
2. Commit and push the relevant changes.
3. If the current branch is not `main`, open a pull request and merge it into `main`.
4. Run `./deploy.sh` from the theme directory.
5. Update the local `main` branch.

Keep unrelated working-tree changes out of the release commit.
