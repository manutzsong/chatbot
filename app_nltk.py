##Replicating example from Stanford literature to show that NLTK Naive  Bayes is calculating its conditionals in a Bernoulli fashion 

##The example can be found here: http://nlp.stanford.edu/IR-book      /html/htmledition/naive-bayes-text-classification-1.html

##They calculate the conditional probability for each label given d5 using both the multinomial model and Bernoulli model.

##When you run this code, the classifier labels d5 as 'japan', which is the case when you calculate the conditional prob in the Bernoulli model.


import nltk
from nltk.classify import NaiveBayesClassifier

#Creating training and test data
d1 = ['chinese', 'beijing', 'chinese']
d2 = ['chinese', 'chinese', 'shanghai']
d3 = ['chinese', 'macao']
d4 = ['tokyo', 'japan', 'chinese']

d5 = ['chinese', 'chinese', 'chinese', 'tokyo', 'japan']

#Feature extractor
def word_feats(words):
   return dict([(word, True) for word in words])

#Feature sets
d1_feats = [(word_feats(d1), 'china')]
d2_feats = [(word_feats(d2), 'china')]
d3_feats = [(word_feats(d3), 'china')]
d4_feats = [(word_feats(d4), 'japan')]

d5_feats = [(word_feats(d5), 'china')]

#Training and Test feature sets
train_feats = d1_feats + d2_feats + d3_feats + d4_feats
test_feats = d5_feats

cl = NaiveBayesClassifier.train(train_feats)

#Creating list of probability distributions to extract probabilities from
probDist = []
for i in range(0, len(test_feats)):
   probdist = cl.prob_classify(test_feats[i][0])
   probDist.append(probdist)

#Creating list of the max probabilities for prediction 
prob = []
for i in range(0, len(probDist)):
   prob.append(probDist[i].prob(probDist[i].max()))

#Creating list of predicted labels for test data
pred_labels = []
for i in range(0, len(test_feats)):
   pred_labels.append(cl.classify(test_feats[i][0]))

#classifying d5_feats
cl.classify([{'chinese': True}]) #returns 'japan' as predicted label
print(word_feats(d5))
