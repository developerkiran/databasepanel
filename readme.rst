databasepanel setup step-by-step
================================================

So, when starting from an existing repository::

  # Clone it or whatever.
  git clone .../something
  cd something
  # Tag the starting point of the tutorial.
  git tag begin
  
And when starting from scratch::

  # Create a new repository.
  git init helloworld
  cd helloworld
  # Create a dummy empty commit.
  git commit --allow-empty --allow-empy-message -m ''
  # Tag it.
  git tag begin
