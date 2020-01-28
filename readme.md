Usage
---
Copy the code and add it to your deploy.php.

You can use it in Gitlab CI:

> vendor/bin/dep rollback $CI_ENVIRONMENT_SLUG  --revision="$CI_COMMIT_SHA" -v

You can also configure it as manual job in Gitlab:

```config 
rollback_here_prod:
  stage: rollback
  <<: *release_template
  only:
    - master
  environment:
    name: production
    url: https://example.com/
  when: manual
``` 
