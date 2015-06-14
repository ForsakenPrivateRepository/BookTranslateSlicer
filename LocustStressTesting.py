from locust import HttpLocust, TaskSet, task

class Behavior(TaskSet):

    @task
    def index(self):
        self.client.get("/")

class LocustStressTesting(HttpLocust):
    task_set = Behavior
    min_wait = 1000
    max_wait = 2000
    host="http://bts.try"

# locust -f LocustStressTesting.py
# http://bts.try:8089/