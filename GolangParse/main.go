package main

import (
	"encoding/json"
	"fmt"
	"io/ioutil"
	"os"
)

type Data struct {
	Item []Item `json:"item"`
}

type Item struct {
	Name    string  `json:"name"`
	Request Request `json:"request"`
}

type Request struct {
	Method string `json:"method"`
}

func main() {
	filename := "postman_collection.json"
	jsonFile, err := os.Open(filename)
	defer jsonFile.Close()
	if err != nil {
		fmt.Printf("failed to open json file: %s, error: %v", filename, err)
		return
	}

	jsonData, err := ioutil.ReadAll(jsonFile)
	if err != nil {
		fmt.Printf("failed to read json file, error: %v", err)
		return
	}

	data := Data{}
	if err := json.Unmarshal(jsonData, &data); err != nil {
		fmt.Printf("failed to unmarshal json file, error: %v", err)
		return
	}

	// Print
	for _, item := range data.Item {
		fmt.Printf("Name: %s, Method: %s \n", item.Name, item.Request.Method)
	}
}
