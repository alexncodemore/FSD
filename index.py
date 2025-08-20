#Create a Node
class Node:
  def __init__(self, value):
    self.data=value
    self.next=None

n = Node("dikshita")
print(n.data)
print(n.next)
print(n)  #address of n (node)

a = Node("a")
b = Node("b")
c = Node("c")
# manually making linked list connections
a.next = b
b.next = c


class LinkedList:
  def __init__(self):
    #Empty linked list
    self.head = None
    self.n = 0  #number of nodes in linked list

  def len(self):
    return self.n

  def insert_head(self, value):
    new_node = Node(value)
    new_node.next = self.head
    self.head = new_node
    self.n += 1

  def __str__(self):
    temp = self.head
    result = ''
    while temp!=None:
      result = result + str(temp.data) + '->'
      temp = temp.next
    return result[:-2]

  def append(self, value):
    new_node = Node(value)
    if self.head is None:
        self.head = new_node
    else:
        temp = self.head
        while temp.next is not None:
            temp = temp.next
        temp.next = new_node
    self.n += 1

  def insert(self, index, value):
    if index < 0 or index > self.n:
      raise IndexError("Invalid index")
    elif index == 0:
      self.insert_head(value)
      self.n +=1
    else:
      new_node = Node(value)
      temp = self.head
      for i in range(index - 1):
        temp = temp.next
      new_node.next = temp.next
      temp.next = new_node
      self.n +=1

  def empty(self):
    self.head = None
    self.n = 0

  def delete_head(self):
    if self.head is None:
      print("Linked list is empty")
    elif self.head.next is None:
      self.head = None
      self.n-=1
    else:
      self.head=self.head.next
      self.n-=1

  def pop(self):
    if self.head is None:
      print("Linked list is empty")
    elif self.head.next is None:
      self.head = None
      self.n-=1
    else:
      temp = self.head
      while temp.next.next is not None:
        temp = temp.next
      temp.next = None
      self.n-=1
  
  def remove(self, value):
    if self.head is None:
      print("Linked list is empty")
    else:
      curr = self.head
      while curr.next is not None:
        if curr.data == value:
          break
        else:
          curr = curr.next
    if curr.next == None:
        print("Not found")
    else:
      curr.next = curr.next.next
      


ll = LinkedList()
ll.append(1)
ll.append(2)
ll.append(3)
ll.append(4)
ll.remove(0)
print(ll)
      
      

    



