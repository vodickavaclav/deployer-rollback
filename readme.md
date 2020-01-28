You can use it in Gitlab CI:

> vendor/bin/dep rollback $CI_ENVIRONMENT_SLUG  --revision="$CI_COMMIT_SHA" -v
