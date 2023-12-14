make update_version:
	git tag --delete 1.0 && git branch -d 1.0 && git push --delete origin 1.0 && git tag 1.0 && git branch 1.0 && git push origin 1.0
